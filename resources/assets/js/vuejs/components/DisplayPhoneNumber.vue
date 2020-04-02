<template>
    <p>
        {{ phone | formatPhone }}
    </p>
</template>

<script>
    export default {
        props: ['phone'],
        filters: {
            formatPhone(value) {
                let format = /(\d{0,3})(\d{0,3})(\d{0,4})/;
                let phoneNumber = value;
                let digits = phoneNumber.replace(/\D/g, '').match(format);
                return !digits[2] ? digits[1] : '(' + digits[1] + ') ' + digits[2] + (digits[3] ? '-' + digits[3] : '');
            }
        }
    }
</script>
