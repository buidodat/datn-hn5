import './bootstrap.js';

window.Echo.channel('vouchers')
    .listen('VoucherCreated', (event) => {
       console.log(event);
       alert(`voucher mới: ${event.title} - ${event.discount} giảm giá`);
    });
