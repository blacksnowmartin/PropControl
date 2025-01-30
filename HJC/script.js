// script.js
document.addEventListener('DOMContentLoaded', () => {
    // Mock Data
    const properties = [
      { name: 'Property A', address: '123 Main St', rentAmount: 500 },
      { name: 'Property B', address: '456 Elm St', rentAmount: 700 },
    ];
  
    const payments = [
      { tenant: 'John Doe', property: 'Property A', amountPaid: 500, date: '2023-10-01', status: 'Paid' },
      { tenant: 'Jane Smith', property: 'Property B', amountPaid: 700, date: '2023-10-05', status: 'Paid' },
    ];
  
    const notifications = [
      { message: 'Rent due for Property A', date: '2023-10-01' },
      { message: 'Rent due for Property B', date: '2023-10-05' },
    ];
  
    // Dashboard Stats
    document.getElementById('total-properties').textContent = properties.length;
    document.getElementById('total-tenants').textContent = 2; // Mock tenants
    document.getElementById('total-payments').textContent = payments.length;
  
    // Render Properties Table
    const propertiesTable = document.getElementById('properties-table').getElementsByTagName('tbody')[0];
    properties.forEach(property => {
      const row = propertiesTable.insertRow();
      row.innerHTML = `
        <td>${property.name}</td>
        <td>${property.address}</td>
        <td>$${property.rentAmount}</td>
        <td><button class="btn">Edit</button> <button class="btn btn-danger">Delete</button></td>
      `;
    });
  
    // Render Payments Table
    const paymentsTable = document.getElementById('payments-table').getElementsByTagName('tbody')[0];
    payments.forEach(payment => {
      const row = paymentsTable.insertRow();
      row.innerHTML = `
        <td>${payment.tenant}</td>
        <td>${payment.property}</td>
        <td>$${payment.amountPaid}</td>
        <td>${payment.date}</td>
        <td>${payment.status}</td>
      `;
    });
  
    // Render Notifications List
    const notificationsList = document.getElementById('notifications-list');
    notifications.forEach(notification => {
      const li = document.createElement('li');
      li.textContent = `${notification.message} - ${notification.date}`;
      notificationsList.appendChild(li);
    });

    // Initialize local storage
    const storedProperties = JSON.parse(localStorage.getItem('properties')) || [];
    const storedTenants = JSON.parse(localStorage.getItem('tenants')) || [];
    
    // Function to save properties to local storage
    function saveProperties() {
      localStorage.setItem('properties', JSON.stringify(storedProperties));
    }

    // Function to save tenants to local storage
    function saveTenants() {
      localStorage.setItem('tenants', JSON.stringify(storedTenants));
    }

    // Add event listeners for modals
    const propertyModal = document.getElementById('property-modal');
    const tenantModal = document.getElementById('tenant-modal');
    const propertyForm = document.getElementById('property-form');
    const tenantForm = document.getElementById('tenant-form');

    document.getElementById('add-property-btn').addEventListener('click', () => {
      propertyModal.style.display = 'block';
    });

    propertyForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('property-name').value;
      const address = document.getElementById('property-address').value;
      const rent = document.getElementById('property-rent').value;
      storedProperties.push({ name, address, rentAmount: rent });
      saveProperties();
      propertyModal.style.display = 'none';
      location.reload(); // Refresh to update the table
    });

    // Close modals
    document.querySelectorAll('.close').forEach(closeBtn => {
      closeBtn.onclick = function() {
        propertyModal.style.display = 'none';
        tenantModal.style.display = 'none';
      }
    });

    // Pop-up notification for rent due
    function checkRentDue() {
      const today = new Date().toISOString().split('T')[0];
      storedProperties.forEach(property => {
        if (property.rentDueDate === today) {
          alert(`Rent is due for ${property.name}`);
        }
      });
    }

    checkRentDue();
  });