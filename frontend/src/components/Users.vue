<template>
    <div>
      <div role="status" class="flex justify-center" v-if="allUsersIsLoading">
        <svg class="inline mr-2 w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#fff" />
        </svg>
      </div>

    <UserList :allUsers="allUsers" :openUserModal="openUserModal" v-if="!allUsersIsLoading" />

    <Pagination :nextPage="nextPage" :prevPage="prevPage" v-if="!allUsersIsLoading"/>

    <Modal v-if="isModalOpen" @close="isModalOpen = false">
      <template #message>
        <div role="status" class="flex justify-center w-full mt-6" v-if="loading">
          <svg class="inline mr-2 w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#fff" />
          </svg>
        </div>
        <div v-else>
          <div class="flex justify-between">
            <div>Latitude: {{ getUser.latitudeAndLongitude?.coord?.lat }}</div>
            <div>Longitude: {{ getUser.latitudeAndLongitude?.coord?.lon }}</div>
          </div>

          <div class="flex justify-between mt-1" v-for="weather in getUser.latitudeAndLongitude?.weather" :key="weather.id">
            <div class="capitalize">Weather: {{ weather?.description }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Temperature (min): {{ getUser.latitudeAndLongitude?.main?.temp_min }}</div>
            <div>Temperature (max): {{ getUser.latitudeAndLongitude?.main?.temp_max }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Temperature: {{ getUser.latitudeAndLongitude?.main?.temp }}</div>
            <div>Feels Like: {{ getUser.latitudeAndLongitude?.main?.feels_like }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Wind Speed: {{ getUser.latitudeAndLongitude?.wind?.speed }}</div>
            <div>Wind Gust: {{ getUser.latitudeAndLongitude?.wind?.gust }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Sunrise: {{ transformToHourMinute(getUser.latitudeAndLongitude?.sys?.sunrise) }}</div>
            <div>Sunset: {{ transformToHourMinute(getUser.latitudeAndLongitude?.sys?.sunset) }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Sea Level: {{ getUser.latitudeAndLongitude?.main?.temp }}</div>
            <div>Pressure: {{ getUser.latitudeAndLongitude?.main?.humidity }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Ground Level: {{ getUser.latitudeAndLongitude?.main?.grnd_level }}</div>
            <div>Visibility: {{ getUser.latitudeAndLongitude?.visibility }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Timezone: {{ convertToTimezone(getUser.latitudeAndLongitude?.timezone) }}</div>
            <div>Humidity: {{ getUser.latitudeAndLongitude?.main?.humidity }}</div>
          </div>

          <div class="flex justify-between mt-1">
            <div>Last Updated: {{ convertToDate(getUser.latitudeAndLongitude?.updated_at) }}</div>
          </div>
        </div>

        <button @click.prevent="isModalOpen = false" class="bg-gray-500 text-white w-full py-1 mt-2 rounded-md hover:bg-gray-500">Close</button>
      </template>
    </Modal>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed, onMounted, ref } from "vue";
import { useUserStore } from "@/stores/User";
import Modal from "./Modal.vue";
import Pagination from "./Pagination.vue";
import UserList from "./UserList.vue";
export default defineComponent({
  components: {
    UserList,
    Modal,
    Pagination,
  },
  setup() {
    const userStore = useUserStore();
    const page = ref<number>(1);
    const isModalOpen = ref<boolean>(false);
    const user = ref<object>({});
    const allUsers = computed(() => userStore.allUsers);
    const getUser = computed(() => userStore.user);
    const loading = computed(() => userStore.loading);
    const allUsersIsLoading = computed(() => userStore.allUsersIsLoading);
    const getError = computed(() => userStore.showError);
    const currentPage = computed(() => userStore.currentPage);
    const lastPage = computed(() => userStore.lastPage);

    const nextPage = (): void => {
      if (lastPage.value === currentPage.value) return;

      page.value++;
      fetchUsers();
    };

    const prevPage = (): void => {
      if (currentPage.value === 1) return;

      page.value--;
      fetchUsers();
    };

    const openUserModal = (id: number): void => {
      isModalOpen.value = true;
      fetchAUser(id);
    };

    const fetchUsers = async () => {
      await userStore.getUsers(page.value);
    };

    const fetchAUser = async (id: number) => {
      await userStore.getUser(id);
    };

    onMounted(() => {
      fetchUsers();
    });

    const transformToHourMinute = (timestamp: number): string => {
      var date = new Date(timestamp * 1000);
      return (
        transformTime(date.getUTCHours()) +
        ":" +
        transformTime(date.getUTCMinutes()) +
        " UTC"
      );
    };

    const transformTime = (time: number): string|number => {
      if (time < 10) {
        return "0" + time;
      }

      return time;
    };

    const convertToTimezone = (offset: number): string => {
      var division = offset / 3600;
      return "UTC" + (division > 0 ? "+" : "") + division;
    };

    const convertToDate = (updated_at: string): string => {
      if (updated_at === undefined || updated_at.length === 0) {
        return "";
      }

      console.log(new Date(updated_at));

      return new Date(updated_at).toUTCString();
    };

    return {
      fetchUsers,
      allUsers,
      loading,
      showError: userStore.showError,
      nextPage,
      prevPage,
      isModalOpen,
      openUserModal,
      user,
      fetchAUser,
      getUser,
      allUsersIsLoading,
      getError,
      currentPage,
      lastPage,
      transformToHourMinute,
      convertToTimezone,
      convertToDate,
    };
  },
});
</script>