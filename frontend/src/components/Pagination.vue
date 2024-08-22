<template>
  <div class="flex justify-center mt-5 text-sm">
    <button class="px-4 py-1 rounded-md bg-white" @click="prevPage()">Previous</button>
    <button class="px-4 py-1 rounded-md bg-white ml-3" @click="nextPage()">Next</button>
  </div>
</template>

<script>
export default {
  props: {
    prevPage: {
      type: Function,
      required: true,
    },
    nextPage: {
      type: Function,
      required: true,
    },
  },
};
</script>
