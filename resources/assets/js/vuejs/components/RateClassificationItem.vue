<template>
    <div class="tw-flex tw-flex-col tw-justify-between sm:tw-justify-around tw-text-center tw-w-1/4 sm:tw-px-6">
        <h3 class="tw-text-primary tw-font-bold tw-leading-tigher sm:leading-none tw-tracking-tighter sm:tw-tracking-normal tw-text-sm md:tw-text-lg" v-text="name"></h3>
        <p class="tw-font-bold tw-leading-tighter sm:leading-none tw-tracking-tighter sm:tw-tracking-normal tw-text-sm sm:tw-text-md md:tw-text-lg">{{ premium | formatNum | dollarFormat }}</p>
    </div>
</template>

<script>

    const numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }   

    export default {
        props: ['name', 'premium'],       
        filters: {
            formatNum(n) {
                
                if (n === 0) {
                    return ' ';
                }

                if ( n.indexOf(".") !== -1 ) {
                    // found a string decimal
                    let final_num = parseFloat(n).toFixed(2);
                    final_num = numberWithCommas(final_num);

                    return final_num;

                    let pieces = n.split(".");
                    let left = pieces[0];
                    let right = pieces[1];
                    right = right.toString();

                    if (right.length > 2) {
                        right = right.replace(/0/g, '');
                    }

                    while(right.length < 2) {
                        right = right + "0";
                    }
                    return left + "." + right;
                }
            },
            dollarFormat(value) {
                return typeof value === 'undefined' ? '' : '$' + value; 
            }
        }      
    }
</script>