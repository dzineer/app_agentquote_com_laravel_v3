<template>
    <fixed-top-nav :delay="500" classes="tw-bg-white mark-fixed-top-nav">

        <div class="dz:section tw-bg-primary tw-flex tw-flex-row tw-items-center tw-justify-center tw-text-white tw-w-full tw-fixed tw-top-0 tw-z-10 mark-top-bar" style="min-height: 45px;">
            <nav class="tw-flex tw-flex-row tw-items-center tw-justify-between tw-justify-center tw-w-full">
                <social-media-bar :icons="icons"></social-media-bar>
                <div class="" :aria-label="aria.phoneLabel" >
                    <display-phone-number phone="phone"></display-phone-number>
                </div>
            </nav>
        </div>

    </fixed-top-nav>
</template>

<script>
    import DisplayPhoneNumber from './DisplayPhoneNumber';

    export default {
      props: ['icons', 'phone'],
      components: {
        DisplayPhoneNumber
      },
      data() {
          return {
              aria: {
                  phoneLabel: ''
              }
          }
      },
      mounted() {
          debugger;
          this.aria.phoneLabel = 'You can contact us by calling us at ' + this.phone;
          // console.dir(this.icons);
      }
    }
</script>
