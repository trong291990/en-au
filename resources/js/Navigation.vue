<template>
  <nav class="flex items-center p-3 flex-wrap">
    <a href="#" class="p-2 mr-4 inline-flex items-center">
      <i class='bx bxs-book-alt mr-2 text-lg pt-1 text-black'></i>
      <span class="text-xl text-black font-bold uppercase tracking-wide">Assimil English</span
      >
    </a>
    <button
        class="text-white inline-flex p-3 bg-black rounded xs:hidden ml-auto outline-none"
        data-target="#navigation"
        @click="toggleNav"
    >
      <i class='bx bx-menu'></i>
    </button>
    <div
        class="top-navbar w-full xs:inline-flex xs:flex-grow xs:w-auto overflow-hidden"
        id="navigation"
        :style="{ height: navHeight }"
    >
      <div
          class="xs:inline-flex xs:flex-row xs:ml-auto xs:w-auto w-full xs:items-center items-start  flex flex-col xs:h-auto"
      >
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>Home</span>
        </a>
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>About</span>
        </a>
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>Services</span>
        </a>
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>Gallery</span>
        </a>
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>Products</span>
        </a>
        <a
            href="#"
            class="xs:inline-flex xs:w-auto w-full px-3 py-2 rounded text-black items-center justify-center hover:bg-gray-900 hover:text-white"
        >
          <span>Contact Us</span>
        </a>
      </div>
    </div>
  </nav>

</template>

<script>
export default {
  name: "Navigation",
  data() {
    return {
      navHeight: "0px",
    };
  },
  methods: {
    toggleNav() {
      this.navHeight = this.navHeight === "0px" ? "auto" : "0px";
    },
  },
}
</script>

<style scoped>

</style>