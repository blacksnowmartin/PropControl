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
  });