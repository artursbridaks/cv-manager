<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <v-img :src="require('../assets/CV_Logo.png')" class="my-3 rounded-xl" contain height="200" />
      </v-col>

      <v-row>
        <v-col cols="12">
          <h2>All CV cards ({{ this.userData.length }})</h2>
        </v-col>

        <v-col class="mb-5" cols="12">
          <v-col class="mb-0">
            <v-btn color="primary" to="/cv-create" exact>
              Add a new CV
            </v-btn>
          </v-col>
        </v-col>

        <v-col cols="12" md="3" v-for="(user, index) in userDataWithEmployment" :key="index">
          <v-card max-width="400" class="ma-2">
            <v-card-title class="headline d-flex justify-center align-center">
              {{ user.name }} {{ user.surname }}
            </v-card-title>
            <v-card-text>
              <v-col class="pa-0 text-center" v-if="user.employment?.company">
                <span class="font-weight-bold">Company:</span>
                {{ user.employment?.company }}
              </v-col>

              <v-col class="pa-0 text-center" v-if="user.employment?.role">
                <span class="font-weight-bold">Role:</span>
                {{ user.employment?.role }}
              </v-col>

              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Phone:</span>
                {{ user.phone_number }}
              </v-col>

              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Phone:</span>
                {{ user.email }}
              </v-col>
            </v-card-text>
            <v-card-actions>
              <v-col cols="12">
                <v-btn color="green" :to="{ path: `/users-data/${user.id}/view` }" exact text>
                  View
                </v-btn>
                <v-btn color="primary" :to="{ path: `/users-data/${user.id}/edit` }" exact text>
                  Edit
                </v-btn>
                <v-btn color="red" @click="showDeleteConfirmation = true" exact text>
                  Delete
                </v-btn>

                <v-dialog v-model="showDeleteConfirmation" persistent max-width="400px">
                  <v-card>
                    <v-card-title class="headline">Confirm Deletion</v-card-title>
                    <v-card-text>Are you sure you want to delete this item?</v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="green darken-1" text @click="showDeleteConfirmation = false">
                        Cancel
                      </v-btn>
                      <v-btn color="red darken-1" text @click="deleteCard(user.id)">
                        Agree
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>

              </v-col>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  name: 'MainPage',

  data: () => ({
    showDeleteConfirmation: false,
    isLoading: false,
    userData: [],
    employment: []
  }),
  mounted() {
    this.getUserData();
    this.getEmploymentData();
  },
  computed: {
    userDataWithEmployment() {
      return this.userData.map(user => {
        let employmentData = this.employment.find(emp => emp.users_data_id === user.id);
        return {
          ...user,
          employment: employmentData
        };
      });
    }
  },
  methods: {
    getUserData() {
      axios.get('http://127.0.0.1:8000/api/users-data')
        .then(response => {
          this.userData = response.data.userData

        })
        .catch(error => console.error('Error fetching user data:', error))
        .finally(() => this.isLoading = false);
    },
    getEmploymentData() {
      axios.get('http://127.0.0.1:8000/api/employment')
        .then(response => {
          this.employment = response.data.employmentData

        })
        .catch(error => console.error('Error fetching employment data:', error))
        .finally(() => this.isLoading = false);
    },
    deleteCard(id) {
      this.showDeleteConfirmation = false;

      axios.delete(`http://127.0.0.1:8000/api/users-data/${id}/delete`)
        .then(response => {
          response
          this.getUserData()
        }).catch(error => {
          this.getUserData()
          console.error('Server error:', error);
          if (error.response && error.response.status === 500) {
            this.errorMessage = 'An error occurred on the server. Please try again later.';
          } else {
            this.errorMessage = 'An error occurred. Please try again.';
          }
        });
    }
  }
}
</script>
