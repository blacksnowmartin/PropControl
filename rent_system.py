import csv
from dataclasses import dataclass
from typing import List, Optional

@dataclass
class Tenant:
    id: int
    name: str
    unit: str
    expected_rent: float
    balance_due: float = 0.0
    status: str = "Unpaid"

class RentCollectionSystem:
    def __init__(self):
        self.tenants: List[Tenant] = []
        self.reconciled_payments = []

    def add_tenant(self, tenant: Tenant):
        tenant.balance_due = tenant.expected_rent
        self.tenants.append(tenant)

    def find_tenant_by_description(self, description: str) -> Optional[Tenant]:
        """
        Logic to match bank transaction descriptions to tenants.
        In a real system, you'd use RegEx or a unique Reference ID.
        """
        desc = description.upper()
        for tenant in self.tenants:
            if tenant.unit.upper() in desc or tenant.name.upper() in desc:
                return tenant
        return None

    def process_bank_statement(self, csv_file: str):
        """
        Processes a bank CSV with columns: Date, Description, Amount
        """
        print(f"{'='*10} Processing Bank Payments {'='*10}")
        
        try:
            with open(csv_file, mode='r') as file:
                reader = csv.DictReader(file)
                for row in reader:
                    date = row['Date']
                    desc = row['Description']
                    amount = float(row['Amount'])

                    tenant = self.find_tenant_by_description(desc)

                    if tenant:
                        tenant.balance_due -= amount
                        if tenant.balance_due <= 0:
                            tenant.status = "Paid"
                        else:
                            tenant.status = "Partial Payment"
                        
                        print(f"[MATCHED] {date}: ${amount} from {tenant.name} ({tenant.unit})")
                        self.reconciled_payments.append({
                            "tenant": tenant.name,
                            "amount": amount,
                            "date": date
                        })
                    else:
                        print(f"[UNKNOWN] {date}: No tenant found for '{desc}'")
        except FileNotFoundError:
            print("Error: Bank statement file not found.")

    def generate_report(self):
        print(f"\n{'='*10} Monthly Rent Report {'='*10}")
        print(f"{'Name':<15} | {'Unit':<8} | {'Status':<15} | {'Balance Due'}")
        print("-" * 55)
        for t in self.tenants:
            print(f"{t.name:<15} | {t.unit:<8} | {t.status:<15} | ${t.balance_due:>10.2f}")

# --- EXAMPLE USAGE ---

# 1. Initialize System
system = RentCollectionSystem()

# 2. Setup Tenants (Balika and Sinawa's owners, perhaps!)
system.add_tenant(Tenant(1, "Alice Smith", "APT-101", 1200.00))
system.add_tenant(Tenant(2, "Bob Jones", "APT-202", 1500.00))
system.add_tenant(Tenant(3, "Charlie Brown", "SUITE-A", 900.00))

# 3. Create a Dummy Bank Statement CSV
with open('bank_data.csv', 'w', newline='') as f:
    writer = csv.writer(f)
    writer.writerow(["Date", "Description", "Amount"])
    writer.writerow(["2023-11-01", "RENT PAYMENT APT-101 ALICE", "1200.00"]) # Full payment
    writer.writerow(["2023-11-02", "TRANSFER FROM BOB JONES", "800.00"])      # Partial payment
    writer.writerow(["2023-11-03", "ATM WITHDRAWAL", "-100.00"])              # Ignore
    writer.writerow(["2023-11-05", "RENT SUITE-A", "900.00"])                 # Full payment

# 4. Run Reconciliation
system.process_bank_statement('bank_data.csv')

# 5. See who still owes money
system.generate_report()