<template>
  <v-container style="width: 1000px; margin-left: 30%;">
    <v-row justify="center">
      <v-col cols="12" sm="8" md="8" lg="8">
        <v-card style="margin-bottom: 20px;">

          <!-- Header: Curriculum Vitae -->
          <v-card-title
            style="background-color: #546E7A; color: white; display: flex; justify-content: center; align-items: center; padding: 10px 0;">
            Curriculum Vitae
          </v-card-title>

          <!-- Personal Information Section -->
          <v-card-text style="text-align: center; padding-top: 20px;">
            <div style="font-size: 30px; color: #424242;">{{ user.baseData.name }} {{ user.baseData.surname }}</div>
            <div style="color: #424242;">{{ user.employment[0].role }}</div>
            <div><span style="font-weight: bold;">Email:</span> {{ user.baseData.email }}</div>
            <div><span style="font-weight: bold;">Phone number:</span> {{ user.baseData.phone_number }}</div>
          </v-card-text>
          <v-divider />

          <!-- Employment Section -->
          <v-card-title
            style="color: black; display: flex; justify-content: center; align-items: center; padding: 10px 0;">
            Employment
          </v-card-title>
          <v-card-text style="text-align: center;">
            <div v-for="job in user.employment" :key="job.id">
              <div><span style="font-weight: bold;">Company:</span> {{ job.company }}</div>
              <div><span style="font-weight: bold;">Role:</span> {{ job.role }}</div>
              <div><span style="font-weight: bold;">Type:</span> {{ job.type }}</div>
              <div><span style="font-weight: bold;">Experience:</span> {{ job.experience }}</div>
              <div><span style="font-weight: bold;">Achievements:</span> {{ job.achievements }}</div>
              <div><span style="font-weight: bold;">Additional skills:</span> {{ job.additional_skills }}</div>
              <v-divider />
            </div>
          </v-card-text>

          <!-- Education Section -->
          <v-card-title
            style="color: black; display: flex; justify-content: center; align-items: center; padding: 10px 0;">
            Education
          </v-card-title>
          <v-card-text style="text-align: center;">
            <div v-for="education in user.education" :key="education.id">
              <div><span style="font-weight: bold;">School:</span> {{ education.school_name }}</div>
              <div><span style="font-weight: bold;">Faculty:</span> {{ education.faculty }}</div>
              <div><span style="font-weight: bold;">Course:</span> {{ education.course }}</div>
              <div><span style="font-weight: bold;">Degree:</span> {{ education.degree }}</div>
              <div><span style="font-weight: bold;">Status:</span> {{ education.status }}</div>
              <v-divider />
            </div>
          </v-card-text>

          <!-- Address Section -->
          <v-card-title
            style="color: black; display: flex; justify-content: center; align-items: center; padding: 10px 0;">
            Address
          </v-card-title>
          <v-card-text style="text-align: center;" v-for="address in user.address" :key="address.id">
            <div><span style="font-weight: bold;">Country:</span> {{ address.country }}</div>
            <div><span style="font-weight: bold;">City:</span> {{ address.city }}</div>
            <div><span style="font-weight: bold;">Street:</span> {{ address.street }}</div>
            <div><span style="font-weight: bold;">Number:</span> {{ address.number }}</div>
            <div><span style="font-weight: bold;">Index:</span> {{ address.index }}</div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import axios from 'axios'

export default {
  name: 'ReportView',
  components: {
  },
  data() {
    return {
      userId: null,
      user: {
        baseData: {
          name: '',
          surname: '',
          email: '',
          phoneNumber: ''
        },
        employment: [
          {
            company: '',
            role: '',
            type: '',
            experience: '',
            achievements: '',
            additional_skills: '',
            from: '',
            to: ''
          }
        ],
        education: [
          {
            schoolName: '',
            faculty: '',
            course: '',
            degree: '',
            status: ''
          }
        ],
        address: {
          country: '',
          city: '',
          street: '',
          number: '',
          index: ''
        }
      }
    };
  },
  userId() {
    return this.userId = this.$route.params.id;
  },
  mounted() {
    this.userId = this.$route.params.id
    this.getUserData(this.userId)
    this.getAllEmploymentDataByUser(this.userId)
    this.getAllEducationDataByUser(this.userId)
    this.getAllAddressDataByUser(this.userId)
  },
  methods: {
    generateReport() {
      this.$refs.html2Pdf.generatePdf()
    },
    getUserData(userId) {
      axios.get(`http://127.0.0.1:8000/api/users-data/${userId}`)
        .then(response => {
          this.user.baseData = response.data.userData
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
    getAllEmploymentDataByUser(userId) {
      axios.get(`http://127.0.0.1:8000/api/employment/user/${userId}`)
        .then(response => {
          this.user.employment = response.data.employmentData
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
    getAllEducationDataByUser(userId) {
      axios.get(`http://127.0.0.1:8000/api/education/user/${userId}`)
        .then(response => {
          this.user.education = response.data.educationData
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
    getAllAddressDataByUser(userId) {
      axios.get(`http://127.0.0.1:8000/api/address/user/${userId}`)
        .then(response => {
          this.user.address = response.data.addressData
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