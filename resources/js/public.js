import './bootstrap.js';

window.Echo.channel('vouchers')
    .listen('VoucherCreated', (e) => {
        const startDateTime = new Date(e.start_date_time);
        const endDateTime = new Date(e.end_date_time);
        const now = new Date();

        console.log(`Voucher: ${e.title}`);
        console.log(`Thời gian bắt đầu: ${startDateTime}`);
        console.log(`Thời gian hiện tại: ${now}`);
        console.log(`Thời gian kết thúc: ${endDateTime}`);

        if (now >= startDateTime && now <= endDateTime) {
            alert(`Voucher đã được phát hành: ${e.title}`);
        } else {
            const timeStart = startDateTime - now;
            if (timeStart > 0) {
                setTimeout(() => {
                    alert(`Voucher đã được phát hành: ${e.title}`);
                }, timeStart);
            }
        }
    });



