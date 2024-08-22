import { defineStore } from "pinia";
import axios from "axios";
import process from "../../env.d";

const api_url = process.env.SERVICE_URL;

export const useUserStore = defineStore("user", {
  state: (): State => {
    return {
      currentPage: 0,
      lastPage: 0,
      allUsers: [],
      user: {},
      loading: false,
      allUsersIsLoading: false,
      showError: "",
    };
  },

  actions: {
    async getUsers(page: number) {
      try {
        this.allUsersIsLoading = true;

        const response = await axios.get(`${api_url}/users?page=${page}`);
        this.allUsers = response.data;
        this.currentPage = response.data.current_page;
        this.lastPage = response.data.last_page;

        this.allUsersIsLoading = false;
      } catch (error) {
        this.showError = error as string;

        this.allUsersIsLoading = false;
      }
    },

    async getUser(id: number) {
      try {
        this.loading = true;

        const response = await axios.get(`${api_url}/users/${id}`);
        this.user = response.data;

        this.loading = false;
      } catch (error) {
        this.showError = error as string;
        this.loading = false;
      }
    },
  },
});

interface State {
  currentPage: number;
  lastPage: number;
  allUsers: [];
  user: object;
  loading: boolean;
  showError: null | string;
  allUsersIsLoading: boolean;
}
