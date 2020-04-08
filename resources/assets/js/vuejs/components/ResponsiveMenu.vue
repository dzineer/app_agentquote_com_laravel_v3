<template>
        <div class="menu-responsive">
            <input type="checkbox" class="toggler" />
            <div class="hamburger">
                <div></div>
            </div>
            <div class="menu-container">
                <div class="menu">
<!--                     <div class="tw-flex tw-justify-start tw-items-center"><img src="https://ppegram.agentquote.com/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png" alt="Website Logo" class="brand-logo"></div>
 -->                    <a v-for="(item, index) in menu" :key="index" :href="item.link" v-text="item.text" class="tw-block tw-no-underline tw-pointer tw-py-4 tw-text-white tw-text-2xl tw-uppercase tw-text-center"></a>
                </div>
                <div class="tw-bg-white tw-flex tw-flex-col tw-items-center tw-justify-center tw-leading-loose tw-mt-8 tw-p-5 tw-rounded-full tw-text-center tw-tracking-widest tw-w-1/2">
                    <h3 class="tw-font-bold tw-text-2xl">Contact Us</h3>
                    <h4 class="tw-text-lg">(888) 223-4773</h4>
                </div>
            </div>

        </div>
</template>

<script>
    export default {
        props: ['menu']

    }
</script>

<style scoped>
    .menu-responsive {
       position: absolute;
       top: 68px;
       right: 10px;
       z-index: 2;
    }

    .menu-responsive .toggler {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 4;
        width: 40px;
        height: 40px;
        cursor: pointer;
    }

    .menu-responsive .hamburger {
        width: 40px;
        height: 40px;
        background-color: white;
        position: relative;
        padding: 1rem;
        background-color: rgba(115, 117, 119, 0.85);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 3;
    }

    .menu-responsive .hamburger > div {
        height: 2px;
        width: 100%;
        background-color: white;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all 0.4s ease;
    }

    .menu-responsive .hamburger > div:before,
    .menu-responsive .hamburger > div:after {
        content: '';
        z-index: 4;
        top: -10px;
        height: 2px;
        width: 100%;
        background-color: white;
        position: absolute;
    }

    .menu-responsive .hamburger > div:after {
        top: 10px;
    }

    .menu-responsive .toggler:checked + .hamburger > div {
        transform: rotate(135deg);
    }

    .menu-responsive .toggler:checked {
        z-index: 5;
    }

    .menu-responsive .toggler:checked + .hamburger {
        z-index: 4;
        background-color: rgba(121, 123, 125, 0.6);
    }

    .menu-responsive .toggler:checked + .hamburger > div:before,
    .menu-responsive .toggler:checked + .hamburger > div:after {
        top: 0px;
        transform: rotate(90deg);
         z-index: 4;
    }

/*     .menu-responsive .toggler:checked + .hamburger > div:before,
    .menu-responsive .toggler:checked + .hamburger > div:after {
        top: 0;
        transform: rotate(90deg);
    } */
    .menu-responsive .toggler:checked:hover + .hamburger > div {
        transform: rotate(225deg);
         z-index: 4;
    }

    .menu-responsive  .menu-container {
        display: none;
        opacity: 0;
    }

    .menu-responsive .toggler:checked + .hamburger + .menu-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #3c8dbc;
        z-index: 3;
        overflow: hidden;
        opacity: 1;
        transform: scale(1);
        transition: all 0.4s ease;
    }

    .menu-responsive .toggler:checked + .hamburger + .menu-container + .menu {
        z-index: 3;
    }

    .menu a {
        width: 100vw;
        padding: 1.5rem;
    }

    .menu a:hover {
       background-color: rgba(30, 101, 181, 0.28);
    }

    @media screen AND (min-width: 569px) {
        .menu-responsive {
            display: none;
        }
    }

</style>
