<template>
  <div class="div d-flex justify-content-between align-items-center mb-1">
    <h3 class="mb-3">Svuotare il carrello?</h3>
    <span class="mb-3 rounded text-success" role="button" @click="deleteCart()"
      ><i class="fa-solid fa-check"></i
    ></span>
    <span class="mb-3 rounded text-danger" role="button" @click="deleteCart()"
      ><i class="fa-solid fa-xmark fa-lg"></i
    ></span>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>