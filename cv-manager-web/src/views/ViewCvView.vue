<template>
  <v-container class="cv-page">
    <v-row justify="center">
      <v-col cols="12" sm="8" md="8" lg="8">
        <v-card class="mb-2">

          <v-card-title class="headline blue-grey darken-1 white--text d-flex justify-center align-center">
            Curriculum Vitae
          </v-card-title>

          <!-- Personal Information Section -->
          <v-card-text class="d-flex flex-column align-center justify-center pt-2">
            <div class="display-1 text--primary">{{ user.baseData.name }} {{ user.baseData.surname }}</div>
            <div class="text--primary">{{ user.employment[0].role }}</div>
            <v-col class="pa-0 text-center">
              <span class="font-weight-bold">Email:</span>
              {{ user.baseData.email }}
            </v-col>
            <v-col class="pa-0 text-center">
              <span class="font-weight-bold">Phone number:</span>
              {{ user.baseData.phone_number }}
            </v-col>
          </v-card-text>
          <v-divider />

          <!-- Employment Section -->
          <v-card-title class="headline d-flex justify-center align-center">Employment</v-card-title>
          <v-card-text>
            <v-timeline dense>
              <v-timeline-item v-for="job in user.employment" :key="job.id">
                <v-card flat>
                  <v-card-title class="headline my-0 py-0"> {{ job.company }}</v-card-title>
                  <v-card-subtitle class="my-0 py-0">{{ job.role }}</v-card-subtitle>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Type:</span> {{ job.type }}
                  </v-card-text>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Experience:</span> {{ job.experience }}
                  </v-card-text>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Achievements:</span> {{ job.achievements }}
                  </v-card-text>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Additional skills:</span> {{ job.additional_skills }}
                  </v-card-text>
                </v-card>
              </v-timeline-item>
            </v-timeline>
          </v-card-text>
          <v-divider />

          <!-- Education Section -->
          <v-card-title class="headline d-flex justify-center align-center">Education</v-card-title>
          <v-card-text>
            <v-timeline dense>
              <v-timeline-item v-for="education in user.education" :key="education.id">
                <v-card flat>
                  <v-card-title class="headline my-0 py-0"> {{ education.school_name }}</v-card-title>
                  <v-card-subtitle class="my-0 py-0">{{ education.faculty }}</v-card-subtitle>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Course:</span> {{ education.course }}
                  </v-card-text>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Degree:</span> {{ education.degree }}
                  </v-card-text>
                  <v-card-text class="my-0 py-0">
                    <span class="font-weight-medium">Status:</span> {{ education.status }}
                  </v-card-text>
                </v-card>
              </v-timeline-item>
            </v-timeline>
          </v-card-text>
          <v-divider />

          <!-- Address Section -->
          <v-card-title class="headline d-flex justify-center align-center">Address</v-card-title>
          <div v-if="user.address && user.address.length > 0">
            <v-card-text class="d-flex flex-column align-center justify-center pt-2" v-for="address in user.address"
              :key="address.id">
              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Country:</span>
                {{ address.country }}
              </v-col>
              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">City:</span>
                {{ address.city }}
              </v-col>
              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Street:</span>
                {{ address.street }}
              </v-col>
              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Number:</span>
                {{ address.number }}
              </v-col>
              <v-col class="pa-0 text-center">
                <span class="font-weight-bold">Index:</span>
                {{ address.index }}
              </v-col>
            </v-card-text>
          </div>
        </v-card>

        <v-col cols="12">
          <v-card-actions class="d-flex justify-center">
            <v-btn color="red" outlined to="/home" exact class="mx-2">
              Back
            </v-btn>
            <v-btn color="grey" class="mx-2" outlined @click=generateReport()>
              Download PDF
            </v-btn>
            <v-btn color="primary" outlined :to="{ path: `/users-data/${userId}/edit` }" exact text class="mx-2">
              Edit
            </v-btn>

            <template>
              <div>
                <VueHtml2pdf :show-layout="false" :float-layout="true" :enable-download="true" :preview-modal="true"
                  :paginate-elements-by-height="1400" :filename="user.baseData.name + ' ' + user.baseData.surname + ' CV'"
                  :pdf-quality="2" :manual-pagination="false" pdf-format="a4" pdf-orientation="landscape"
                  pdf-content-width="800px" ref="html2Pdf">
                  <section slot="pdf-content">
                    <!-- PDF Content Here -->
                    <Report />
                  </section>
                </VueHtml2pdf>
              </div>
            </template>

          </v-card-actions>
        </v-col>
      </v-col>
    </v-row>

  </v-container>
</template>

<script>
import axios from 'axios'
import VueHtml2pdf from 'vue-html2pdf'
import Report from '@/components/Report.vue';

export default {
  components: {
    VueHtml2pdf,
    Report
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
