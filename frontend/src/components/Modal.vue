<template>
  <div>
    <section @click="close" class="z-40 h-screen w-screen bg-gray-500 fixed top-0 left-0 opacity-50"></section>
    <transition name="fade">
      <div class="absolute inset-0">
        <div class="flex h-full">
          <div class="z-50 m-auto rounded shadow w-10/12 md:w-1/3">
            <div class="p-2">
              <div class="rounded-lg bg-white border border-stone-500 overflow-hidden w-full relative">
                <div class="pb-4">
                  <div class="">
                    <div class="text-center text-black text-sm px-4">
                      <div class="font-bold text-center my-5">User Weather Info</div>
                      <slot name="message"></slot>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  setup(_, { emit }) {
    function close() {
      emit("close");
    }
    return { close };
  },
};
</script>
