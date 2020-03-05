let formDataUtils = (function() {
    let $ = {
      fn: (function () {
         return {
             toDataForm: function(o) {
                 let data = new FormData;

                 if (typeof o === "undefined") {
                     return false;
                 }

                 for ( let key in o ) {
                     if (o.hasOwnProperty(key)) {
                         data.append(key, o[key]);
                     }
                 }
                 return data;
             }
         }
      }())
    };

    return {
        toDataForm: $.fn.toDataForm
    }

}());

let request = (function( options ) {
    let $ = {
        fn: (function () {
           return {
               getRequest: (url)=>  {
                   let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                   return fetch(url,
                       {
                           method: "GET",
                           headers: {
                               'Accept': 'application/json',
                               'X-CSRF-TOKEN': token
                           },
                           credentials: 'same-origin'
                       });
               },
               postRequest: (url, data)=>  {
                   let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                   return fetch(url,
                       {
                           method: "POST",
                           headers: {
                               'Accept': 'application/json',
                               //    'Content-Type': 'application/json',
                               'X-Requested-With': 'XMLHttpRequest',
                               'X-CSRF-TOKEN': token
                           },
                           credentials: 'same-origin',
                           body: data
                       });
               },
               putRequest: (url, data)=>  {
                   data.append('_method', 'PUT' );
                   let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                   return fetch(url,
                       {
                           method: "POST",
                           headers: {
                               'Accept': 'application/json',
                               //    'Content-Type': 'application/json',
                               'X-Requested-With': 'XMLHttpRequest',
                               'X-CSRF-TOKEN': token
                           },
                           credentials: 'same-origin',
                           body: data
                       });
               },
               deleteRequest: (url, data)=>  {
                   data.append('_method', 'DELETE' );
                   let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                   return fetch(url,
                       {
                           method: "POST",
                           headers: {
                               'Accept': 'application/json',
                               //    'Content-Type': 'application/json',
                               'X-Requested-With': 'XMLHttpRequest',
                               'X-CSRF-TOKEN': token
                           },
                           credentials: 'same-origin',
                           body: data
                       });
               },
           }
        }())
    };

    return {
        get: $.fn.getRequest,
        post: $.fn.postRequest,
        put: $.fn.putRequest,
        delete: $.fn.deleteRequest,
        toDataForm: options.dataUtils.toDataForm
    }

}({
  dataUtils: formDataUtils
}));

export default request;