<template>
    <div class="tw-w-full mark-fixed-top-nav">
        <div class="md:tw-block" :class="classes">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';

export default {
   props: ['delay', 'classes', 'offsetFromTheTop'],
   mounted() {
       let el = this.$el;
       let originalOffsetTop = this.$el.offsetTop;
       let offsetFromTop = this.offsetFromTheTop || 0;

       window.addEventListener('scroll',
         _.throttle(function() {
              // console.log('scrolling');

               if (offsetFromTop > 0) {

                    el.classList[
                        window.scrollY >= originalOffsetTop ? 'add' : 'remove'
                    ]('tw-fixed',
                        'tw-w-full',
                        'tw-top-0',
                        'tw-z-20');
               } else {
                    el.classList[
                        window.scrollY >= originalOffsetTop ? 'add' : 'remove'
                    ]('tw-fixed',
                        'tw-w-full',
                        'tw-top-0',
                        'tw-z-20');
               }


/*            if (window.scrollY >= originalOffsetTop) {
               // debugger;

               el.classList.add(
                   'tw-fixed',
                   'tw-w-full',
                   'tw-top-0',
                   'tw-z-10'
               );
           } else {
               el.classList.remove(
                   'tw-fixed',
                   'tw-w-full',
                   'tw-top-0',
                   'tw-z-10'
               );
           } */
        }, this.delay)
       );
   }
}
</script>
