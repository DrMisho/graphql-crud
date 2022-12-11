<template>
  <div id="app">
    <div id="nav" class="bg-purple-600">
      <div class="container flex items-center justify-between py-6">
        <div>
          <a href="/"><img src="./assets/logo.png" alt="logo" class="w-14 ml-20"></a>
        </div>
        <div>
          <router-link to="/" class="text-white hover:text-green-500">Home</router-link>
          <router-link to="/about" class="text-white hover:text-green-500 pl-2">About</router-link>
        </div>
      </div>
    </div>
    <router-view/>
    <p class="bg-black text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, quas dicta recusandae, officia sapiente doloribus nobis architecto quibusdam aperiam earum incidunt vero placeat provident beatae optio pariatur labore laudantium. Reiciendis?</p>
  </div>
</template>

<style src="./assets/main.css">
