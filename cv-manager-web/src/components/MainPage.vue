<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <v-img :src="require('../assets/CV_Logo.png')" class="my-3 rounded-xl" contain height="200" />
      </v-col>

      <v-row>
        <v-col cols="12">
          <h2>All CV's</h2>
        </v-col>

        <v-col cols="12" md="3" v-for="(user, index) in this.person.baseData" :key="index">
          <v-card max-width="400" class="ma-2">
            <v-card-title class="headline d-flex justify-center align-center">{{ user.name }} {{ user.surname
            }}</v-card-title>
            <v-card-text>
              <div>{{ user.email }}</div>
              <div>{{ user.phone_number }}</div>
            </v-card-text>
            <v-card-actions>
              <v-col cols="12">
                <v-btn color="green" :to="{ path: `/users-data/${user.id}` }" exact text>
                  View
                </v-btn>
                <v-btn color="primary" :to="{ path: `/users-data/${user.id}/edit` }" exact text>
                  Edit
                </v-btn>
                <v-btn color="red" @click="deleteCard(user.id)" exact text>
                  Delete
                </v-btn>
              </v-col>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>


      <v-col class="mb-5" cols="12">
        <v-col class="mb-8">
          <v-btn color="primary" to="/cv-create" exact>
            Add a new CV
          </v-btn>
        </v-col>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  name: 'MainPage',

  data: () => ({
    dialog: false,
    person: {
      baseData: {
        name: '',
        surname: '',
        phoneNumber: '',
        email: ''
      }
    }
  }),
  mounted() {
    this.getUserData();
  },
  methods: {
    getUserData() {
      axios.get('http://127.0.0.1:8000/api/users-data')
        .then(response => {
          this.person.baseData = response.data.userData
        })
    },
    deleteCard(id) {
      axios.delete(`http://127.0.0.1:8000/api/users-data/${id}/delete`)
        .then(response => {
          console.log('Item deleted:', response.data);
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
    },
  },
  computed: {
  }
}
</script>
