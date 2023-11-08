<template>
  <v-container class="cv-page">
    <!-- Personal Information Section -->
    <v-row>
      <v-col cols="12">
        <v-card class="mb-4">
          <v-card-title class="headline blue-grey darken-1 white--text">Personal Information</v-card-title>
          <v-card-text>
            <span class="display-1 text--primary">{{ person.baseData.name }}</span>
            <div class="title mb-2">{{ person.baseData.surname }}</div>
            <div class="subtitle-1">{{ person.baseData.email }}</div>
            <div class="body-1">{{ person.baseData.phone_number }}</div>
          </v-card-text>
          <!-- Experience Section -->
          <v-card-title class="headline">Employment</v-card-title>
          <v-card-text>
            <v-timeline dense>
              <v-timeline-item v-for="job in person.employment" :key="job.company" color="teal">
                <v-card>
                  <v-card-title class="headline">{{ job.name }}</v-card-title>
                  <v-card-subtitle>{{ job.role }}</v-card-subtitle>
                </v-card>
              </v-timeline-item>
            </v-timeline>
          </v-card-text>
          <!-- Education Section -->
          <v-card-title class="headline">Education</v-card-title>
          <v-card-text>
            <v-list>
              <v-list-item-group>
                <v-list-item v-for="education in person.education" :key="education.institution">
                  <v-list-item-content>
                    <v-list-item-subtitle>{{ education.schoolName }}</v-list-item-subtitle>
                    <v-list-item-subtitle>{{ education.course }}</v-list-item-subtitle>
                    <v-list-item-title>{{ education.degree }}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card-text>
          <!-- Address Section -->
          <v-card-title class="headline">Address</v-card-title>
          <v-card-text>
            <span class="title mb-2">{{ person.address.country }}</span>
            <div class="title mb-2">{{ person.address.city }}</div>
            <div class="subtitle-1">{{ person.address.street }}</div>
            <div class="body-1">{{ person.address.number }}</div>
            <div class="body-1">{{ person.address.index }}</div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

  </v-container>
</template>

<script>
import axios from 'axios'


export default {
  data() {
    return {
      person: {
        baseData: {
          name: '',
          surname: '',
          email: '',
          phoneNumber: ''
        },
        employment: [
          {
            name: 'Test',
            role: 'Full-Stack Developer',
            load: 'Full-time',
            experience: 3,
            achievements: 'Achievements',
            additionalSkills: 'Additional skills'
          },
          {
            name: 'Test 1',
            role: 'Full-Stack Developer',
            load: 'Full-time',
            experience: 1,
            achievements: 'Achievements',
            additionalSkills: 'Additional skills'
          }
        ],
        education: [
          {
            schoolName: 'RTU',
            faculty: 'Faculty Name',
            course: 'Course Name',
            degree: 'Degree level',
            status: 'Graduated'
          },
          {
            schoolName: 'Test',
            faculty: 'Faculty Name',
            course: 'Course Name',
            degree: 'Degree level',
            status: 'Graduated'
          }
        ],
        address: {
          country: 'Country name',
          city: 'City name',
          street: 'Street name',
          number: 'Number',
          index: 'LV-0000'
        }
      }
    };
  },
  mounted() {
    this.userId = this.$route.params.id
    this.getUserData(this.userId)
    console.log();
  },
  methods: {
    getUserData(userId) {
      axios.get(`http://127.0.0.1:8000/api/users-data/${userId}/edit`)
        .then(response => {
          this.person.baseData = response.data.userData
        })
        .catch(function (error) {
          if (error.response) {
            if (error.response.status == 404) {
              error.response.data.message
            } else if (error.response.status == 500) {
              error.response.data.message
            }
          }
        })
    },
  }
};
</script>
