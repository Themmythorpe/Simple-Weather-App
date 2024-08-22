<template>
  <div class="container mx-auto shadow border">
    <table style="width: 100%">
      <thead class="bg-gray-50">
      <tr>
        <th class="px-6 py-2 text-xs text-gray-500">ID</th>
        <th class="px-6 py-2 text-xs text-gray-500">Name</th>
        <th class="px-6 py-2 text-xs text-gray-500">Email</th>
        <th class="px-6 py-2 text-xs text-gray-500">Current Weather</th>
        <th class="px-6 py-2 text-xs text-gray-500">Actions</th>
      </tr>
      </thead>
      <tbody class="bg-white">
      <tr v-for="user in allUsers.data" >
        <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ user.id }}</td>
        <td class="px-6 py-4 text-gray-500 text-center">{{ user.name }}</td>
        <td class="px-6 py-4 text-gray-500 text-center">{{ user.email }}</td>
        <td class="px-6 py-4 text-sm text-gray-500 text-center capitalize">Weather: {{ user.weather?.data?.weather[0]?.description }}, Feels like: {{ user.weather?.data?.main?.feels_like }}</td>
        <td class="px-6 py-4 text-center">
          <a href="#" @click="openUserModal(user.id)" class="px-4 py-1 text-sm text-white bg-gray-500 rounded">Detailed Weather</a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'UserList',
  props: {
    allUsers: {
      type: Object,
      required: true,
    },
    openUserModal: {
      type: Function,
      required: true,
    },
  },
};
</script>

<style scoped>
/* Add any necessary styles here */
</style>
