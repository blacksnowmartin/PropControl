require 'date'
require 'csv'

# Data structure for a Tenant
class Tenant
  attr_accessor :id, :name, :apartment, :rent_amount, :status

  def initialize(id, name, apartment, rent_amount)
    @id = id
    @name = name
    @apartment = apartment
    @rent_amount = rent_amount
    @status = "Unpaid"
  end
end

# Logic to handle bank data reconciliation
class RentSystem
  def initialize
    @tenants = []
    @processed_payments = []
  end

  def add_tenant(tenant)
    @tenants << tenant
  end

  # Simulate importing a CSV from a bank (Date, Description, Amount)
  # Bank descriptions usually look like: "RENT-101-SMITH" or "TRNSFR-APT202"
  def process_bank_csv(file_path)
    puts "--- Starting Bank Reconciliation ---"
    
    CSV.foreach(file_path, headers: true) do |row|
      amount = row['Amount'].to_f
      description = row['Description'].upcase
      date = row['Date']

      # Match the bank payment to a tenant based on Apartment ID or Name in description
      tenant = @tenants.find { |t| description.include?(t.apartment) || description.include?(t.name.upcase) }

      if tenant
        if amount >= tenant.rent_amount
          tenant.status = "Paid (Full)"
          puts "[SUCCESS] #{date}: Payment of $#{amount} matched to #{tenant.name} (#{tenant.apartment})"
        else
          tenant.status = "Partial Payment ($#{amount})"
          puts "[ALERT] #{date}: Underpayment of $#{amount} from #{tenant.name}"
        end
        @processed_payments << {tenant_id: tenant.id, amount: amount, date: date}
      else
        puts "[UNKNOWN] #{date}: Could not match payment '#{description}' to any tenant."
      end
    end
  end

  def report
    puts "\n--- Rent Status Report ---"
    @tenants.each do |t|
      puts "Tenant: #{t.name} | Unit: #{t.apartment} | Status: #{t.status}"
    end
  end
end

# --- RUNNING THE SYSTEM ---

system = RentSystem.new

# Add our database of tenants
system.add_tenant(Tenant.new(1, "John Smith", "APT101", 1200))
system.add_tenant(Tenant.new(2, "Jane Doe", "APT202", 1500))
system.add_tenant(Tenant.new(3, "Robert Brown", "APT303", 1100))

# Normally, you would import a real file. Here we create a mock CSV string for the demo:
File.write('bank_statement.csv', <<~CSV
  Date,Description,Amount
  2023-10-01,RENT PAYMENT APT101 SMITH,1200.00
  2023-10-02,TRANSFER FROM JANE DOE APT202,1500.00
  2023-10-03,UNKNOWN VENDOR CAFE,15.50
  2023-10-04,APT303 RENT,500.00
CSV
)

system.process_bank_csv('bank_statement.csv')
system.report