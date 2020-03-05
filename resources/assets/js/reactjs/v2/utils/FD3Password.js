let passwordGenerator = (function() {
    let $ = {
        fn: (function () {
            return {
                generate: function(length) {
                    let chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
                    let pass = "";
                    for (let x = 0; x < length; x++) {
                        let i = Math.floor(Math.random() * chars.length);
                        pass += chars.charAt(i);
                    }
                    return pass;
                }
            }
        }())
    };

    return {
        generate: $.fn.generate
    }

}());

export default passwordGenerator;