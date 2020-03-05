
toastr.options = {
    "debug": false,
    "positionClass": "toast-bottom-right",
    "onclick": null,
    "fadeIn": 300,
    "fadeOut": 1000,
    "timeOut": 5000,
    "extendedTimeOut": 21000
};

window.messaging = (function(toastr) {
    let $ = {
      fn: (function () {
         return {
             message: (type, msg) => {
                 switch(type) {
                     case 'success':
                         toastr.success(msg);
                         break;
                     case 'warn':
                         toastr.warn(msg);
                         break;
                     case 'info':
                         toastr.info(msg);
                         break;
                     case 'error':
                         toastr.error(msg);
                         break;

                     default:
                         toastr.info(msg);
                 }
             },
             success: (msg) => {
                 $.fn.message('success', msg);
             },
             warn: (msg) => {
                 $.fn.message('warn', msg);
             },
             info: (msg) => {
                 $.fn.message('info', msg);
             },
             error: (msg) => {
                 $.fn.message('error', msg);
             }
         }
      }())
    };

    return {
        message: $.fn.message,
        success: $.fn.success,
        warn: $.fn.warn,
        info: $.fn.info,
        error: $.fn.error,
    }

}(toastr));
