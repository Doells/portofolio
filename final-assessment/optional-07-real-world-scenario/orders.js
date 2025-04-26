// Gunakan fungsi di bawah ini untuk menghasilkan id yang unik
function generateUniqueId() {
  return `_${Math.random().toString(36).slice(2, 9)}`;
}


// TODO: buatlah variabel yang menampung data orders
let orders = [];

// TODO: selesaikan fungsi addOrder
function addOrder(customerName, items) {
  const totalPrice = items.reduce((sum, item) => sum + (item.price * (item.quantity || 1)), 0); // Menghitung total harga pesanan
  const newOrder = {
    id: generateUniqueId(),
    customerName,
    items,
    totalPrice,  // Total harga pesanan
    status: 'Menunggu',  // Status awal pesanan adalah 'Menunggu'
  };
  orders.push(newOrder);  // Menambahkan pesanan ke dalam array orders
  console.log(`Pesanan untuk ${customerName} berhasil ditambahkan.`);
  return newOrder;
}

// TODO: selesaikan fungsi updateOrderStatus
function updateOrderStatus(orderId, status) {
  const order = orders.find(order => order.id === orderId);
  if (order) {
    order.status = status;
    console.log(`Status pesanan ${orderId} diperbarui menjadi: ${status}`);
  } else {
    console.log(`Pesanan dengan ID ${orderId} tidak ditemukan.`);
  }
}

// TODO: selesaikan fungsi calculateTotalRevenue dari order yang berstatus Selesai
function calculateTotalRevenue() {
  const completedOrders = orders.filter(order => order.status === 'Selesai');  // Menyaring pesanan yang sudah selesai
  let totalRevenue = 0;
  completedOrders.forEach(order => {
    totalRevenue += order.totalPrice;  // Menjumlahkan total harga dari semua pesanan yang selesai
  });
  return totalRevenue;
}

function listOrders() {
  console.log("Daftar Pesanan:");
  orders.forEach(order => {
    console.log(`ID: ${order.id}`);
    console.log(`Customer: ${order.customerName}`);
    console.log(`Status: ${order.status}`);
    console.log(`Total Price: ${order.totalPrice}`);
    console.log("Items:");
    order.items.forEach(item => {
      console.log(`  - ${item.name}: Quantity ${item.quantity}, Price ${item.price}, Total ${item.price * item.quantity}`);
    });
    console.log("----");
  });
}


// TODO: selesaikan fungsi deleteOrder
function deleteOrder(orderId) {
  const orderIndex = orders.findIndex(order => order.id === orderId);
  if (orderIndex !== -1) {
    orders.splice(orderIndex, 1);
    console.log(`Pesanan dengan ID ${orderId} berhasil dihapus.`);
  } else {
    console.log(`Pesanan dengan ID ${orderId} tidak ditemukan.`);
  }
}


export { orders, addOrder, updateOrderStatus, calculateTotalRevenue, listOrders, deleteOrder };
