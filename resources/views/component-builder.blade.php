<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   {{--  <meta name="csrf-token" content="0a8dsf09asd809f8asd0f8asd9fads"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Termlife Landing Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/landing.css">

    <style>
        .tw-box {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <div id="app">

        <top-bar :icons="socialMediaIcons" :items="topMenuItems"></top-bar>
        <!-- <responsive-menu :menu="items"></responsive-menu> -->
        <header-logo path="/storage/landing-pages/logos/design-logo.svg"></header-logo>

        <div class="tw-flex tw-w-full tw-bg-blue-900" style="height: 80vh;">
            <div class="tw-flex tw-flex-col tw-w-1/4 tw-bg-blue-900 tw-border-r-2 tw-border-gray-400 tw-p-4" style="background-color:#f3f3f3;">

                <h2 class="tw-text-2xl">New element</h2>

                <div class="tw-w-full tw-flex">
                    <button v-for="item in elementsList" class="tw-w-full tw-my-2 tw-w-8 tw-h-8 tw-p-1 tw-bg-blue-500 hover:tw-bg-blue-400 tw-text-white tw-mx-1 tw-rounded" :name="item.elment" v-text="item.elment" @click="selectedActionButton" ></button>
                </div>

                <div class="tw-w-full tw-flex tw-flex-col">
                    <input v-for="prop in elementProperties" class="tw-w-full tw-my-2 tw-w-8 tw-h-8 tw-p-1 tw-bg-blue-500 hover:tw-bg-blue-400 tw-text-white tw-mx-1 tw-rounded" :name="prop" :value="prop" />
                </div>

                <label>Classes:</label>
                <textarea class="tw-w-full tw-h-8 tw-mt-1 tw-h-20" v-model="classes"></textarea>
                <!-- <select class="tw-my-2 tw-py-2 tw-px-4 tw-bg-blue-500 tw-text-white" name="" id="" size="3">
                    <option v-for="item in classesList" :value="item" v-text="item"></option>
                </select> -->
                <button class="tw-my-2 tw-py-4 tw-px-2 tw-rounded tw-bg-blue-500 tw-text-white" @click="addDiv">New element</button>

                <h2 class="tw-my-4 tw-text-2xl">Selected element</h2>

                <label>Classes:</label>
                <textarea class="tw-w-full tw-h-8 tw-mt-1 tw-h-20" v-model="selectedElement.classList"></textarea>
                <textarea class="tw-w-full tw-h-8 tw-mt-1 tw-h-20" v-model="selectedElement.innerHTML"></textarea>
                <p v-for="prop in this.selectedElementProperties" v-text="prop.key"></p>
                <button class="tw-my-2 tw-py-4 tw-px-2 tw-rounded tw-bg-red-500 tw-text-white" @click="removeElement">Delete element</button>
            </div>
            <div class="tw-flex tw-flex-col tw-w-3/4 tw-bg-white tw-p-4">
                <div id="builder-container" @click="onSelected">
                
                </div>
                <textarea id="builder-html" v-text="builderHTML" class="tw-my-20">
                
                </textarea>                

            </div>
        </div>
        <!-- <signup placeholder="10,000-5,000,000" userid="47" :show="showSignupBar"></signup> -->

{{--         <div class="tw-h-screen-off tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-2">
            <needs-analyser :show="showCalculator"></needs-analyser>
        </div> --}}

    </div>

    <script src="/js/landing.js"></script>
</body>
</html>