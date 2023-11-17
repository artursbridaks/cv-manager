<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mt-6" cols="12">
        <h2>Edit CV</h2>

        <v-row class="pt-6" justify="center">
          <v-card width="900">

            <v-row justify="center" class="pt-4">
              <v-col cols="12" md="6" class="d-flex flex-column align-center justify-center"
                v-if="Object.keys(this.errorList).length > 0">
                <v-alert v-for="(error, index) in this.errorList" :key="index" type="error" dense outlined
                  color="pink lighten-2">
                  {{ error[0] }}
                </v-alert>
              </v-col>
            </v-row>

            <v-row justify="center">
              <v-col cols="12" sm="6" class="pt-8">

                <v-form>

                  <!-- Personal information -->
                  <div v-if="step === 1">
                    <span class="font-weight-medium">Personal information</span>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Name:</span>
                      <v-text-field counter :maxlength="30" class="ma-0" v-model="user.userData.name" outlined dense>
                      </v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Surname:</span>
                      <v-text-field counter :maxlength="30" v-model="user.userData.surname" outlined dense></v-text-field>
                    </v-col>


                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Email:</span>
                      <v-text-field counter :maxlength="50" v-model="user.userData.email" outlined dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Phone number:</span>
                      <v-text-field counter :maxlength="8" type="number" v-model="user.userData.phone_number" outlined
                        dense></v-text-field>
                    </v-col>
                  </div>

                  <!-- Employment -->
                  <div v-if="step === 2">
                    <span class="font-weight-medium">Employment</span>
                    <v-col v-for="(job, index) in user.employment" :key="index">

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Company:</span>
                        <v-text-field counter :maxlength="50" v-model="job.company" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Role:</span>
                        <v-text-field counter :maxlength="50" v-model="job.role" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Type:</span>
                        <v-combobox clearable outlined dense v-model="job.type"
                          :items="['Full-time', 'Part-time', 'Freelance', 'Other']">
                        </v-combobox>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Experience:</span>
                        <v-text-field counter :maxlength="2" v-model="job.experience" type="number" outlined
                          dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Achievements:</span>
                        <v-textarea counter :maxlength="200" v-model="job.achievements" outlined dense rows="1"
                          auto-grow></v-textarea>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Additional skills:</span>
                        <v-textarea counter :maxlength="200" v-model="job.additional_skills" outlined dense rows="1"
                          auto-grow></v-textarea>
                      </v-col>

                      <v-card-actions>
                        <v-row class="d-flex flex-column align-center justify-center">
                          <v-col cols="12" class="d-flex flex-column align-center justify-center">
                            <v-btn color="red" @click="deleteEmployment(job.id, index)" exact text>
                              Delete Entry above
                            </v-btn>
                          </v-col>
                        </v-row>
                      </v-card-actions>
                      <v-divider />
                    </v-col>
                    <v-col cols="12" class="d-flex flex-column align-center justify-center" v-if="step === 2">
                      <v-btn color="green" @click="addEmployment()" exact text>
                        Add another entry
                      </v-btn>
                    </v-col>
                  </div>

                  <!-- Education -->
                  <div v-if="step === 3">
                    <span class="font-weight-medium">Education</span>
                    <v-col v-for="(education, index) in user.education" :key="index">

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">School:</span>
                        <v-text-field counter :maxlength="50" v-model="education.school_name" outlined
                          dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Faculty:</span>
                        <v-text-field counter :maxlength="50" v-model="education.faculty" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Course:</span>
                        <v-text-field counter :maxlength="50" v-model="education.course" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Degree:</span>
                        <v-text-field counter :maxlength="50" v-model="education.degree" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Status:</span>
                        <v-combobox clearable outlined v-model="education.status"
                          :items="['Still studying', 'Graduated', 'Dropped Out', 'Other']">
                        </v-combobox>
                      </v-col>

                      <v-card-actions>
                        <v-row class="d-flex flex-column align-center justify-center">
                          <v-col cols="12" class="d-flex flex-column align-center justify-center">
                            <v-btn color="red" @click="deleteEducation(education.id, index)" exact text>
                              Delete Entry above
                            </v-btn>
                          </v-col>
                        </v-row>
                      </v-card-actions>
                    </v-col>

                    <v-divider />
                    <v-col cols="12" class="d-flex flex-column align-center justify-center" v-if="step === 3">
                      <v-btn color="green" @click="addEducation()" exact text>
                        Add another entry
                      </v-btn>
                    </v-col>
                  </div>

                  <!-- Address -->
                  <div v-if="step === 4">
                    <v-col v-for="(address, index) in user.address" :key="index">

                      <span class="font-weight-medium">Address</span>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Country:</span>
                        <v-text-field counter :maxlength="100" v-model="address.country" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">City:</span>
                        <v-text-field counter :maxlength="50" v-model="address.city" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Street:</span>
                        <v-text-field counter :maxlength="50" v-model="address.street" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Number:</span>
                        <v-text-field counter :maxlength="10" v-model="address.number" outlined dense></v-text-field>
                      </v-col>

                      <v-col class="pa-0 text-left">
                        <span class="font-weight-medium">Index:</span>
                        <v-text-field counter :maxlength="10" v-model="address.index" outlined dense></v-text-field>
                      </v-col>
                    </v-col>
                  </div>

                </v-form>

              </v-col>
            </v-row>

            <v-card-actions>
              <v-col cols="12">
                <v-btn color="red" outlined @click="back()" exact text class="mr-2" v-if="this.step > 1">Back</v-btn>
                <v-btn color="green" outlined @click="nextStep()" exact text v-if="this.step < 5">Next</v-btn>
              </v-col>
            </v-card-actions>

            <v-card-actions v-if="this.step == 5">
              <v-row class="d-flex flex-column align-center justify-center">
                <v-col cols="12" class="d-flex flex-column align-center justify-center">
                  All fields finished!
                </v-col>

                <v-col cols="12" class="d-flex flex-column align-center justify-center">
                  <v-btn outlined color="green" :to="{ path: `/users-data/${this.$route.params.id}/view` }" exact text>
                    View
                  </v-btn>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-row>

        <v-col class="mb-5" cols="12">
          <v-col class="mb-8">
            <v-btn color="red" to="/" exact>
              Back to home
            </v-btn>
          </v-col>
        </v-col>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  name: 'EditCV',

  data: () => ({
    errorList: '',
    step: 1,
    user: {
      userData: {
        name: '',
        surname: '',
        email: '',
        phone_number: ''
      },
      employment: {
        company: '',
        role: '',
        type: '',
        experience: '',
        achievements: '',
        additional_skills: '',
        from: '',
        to: ''
      },
      education: {
        school_name: '',
        faculty: '',
        course: '',
        degree: '',
        status: '',
        from: '',
        to: ''
      },
      address: {
        id: '',
        country: '',
        city: '',
        street: '',
        number: '',
        index: ''
      }
    }
  }),
  created() {
    if (!this.user.employment || this.user.employment.length === 0) {
      this.user.employment = [{
        company: '',
        role: '',
        type: '',
        experience: '',
        achievements: '',
        additional_skills: '',
        from: '',
        to: ''
      }];
    }
  },
  mounted() {
    this.userId = this.$route.params.id
    this.getUserData(this.userId)
    this.getAllEmploymentDataByUser(this.userId)
    this.getAllEducationDataByUser(this.userId)
    this.getAddressData(this.userId)
  },
  methods: {
    async nextStep() {
      try {
        if (this.step === 1) {
          this.updateUserData();
        } else if (this.step === 2) {
          await this.updateEmploymentData();
        } else if (this.step === 3) {
          await this.updateEducationData();
        } else if (this.step === 4) {
          this.updateAddressData();
        }
        this.errorList = ''
      } catch (error) {
        console.log('Error in nextStep:', error);
      }
    },
    back() {
      if (this.step >= 1) {
        this.errorList = ''
        return this.step--
      }
    },
    /* USER DATA */
    getUserData(userId) {
      axios.get(`http://127.0.0.1:8000/api/users-data/${userId}/edit`)
        .then(response => {
          this.user.userData = response.data.userData
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
    updateUserData() {
      var myVar = this;
      axios.put(`http://127.0.0.1:8000/api/users-data/${this.userId}/edit`, this.user.userData)
        .then(response => {
          response

          this.errorList = ''
        }).catch(function (error) {
          if (error.response) {
            if (error.response.status == 422) {
              myVar.errorList = error.response.data.error
            }
            if (error.response.status == 404) {
              alert('No user found!')
            }
          } else if (error.request) {
            console.log(error.request)
          } else {
            console.log('Error: ', error.message)
          }
        }).then(() => {
          if (!Object.keys(this.errorList).length) {
            this.step = 2
          }
        });
    },
    /* EMPLOYMENT DATA*/
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
    updateEmploymentData() {
      var myVar = this;
      return new Promise((resolve, reject) => {
        axios.put(`http://127.0.0.1:8000/api/employment/update`, { employmentData: this.user.employment })
          .then(response => {
            if (response.data.status === 200) {
              console.log(response.data.message);
              resolve(true);
            }
          }).catch(function (error) {
            if (error.response) {
              if (error.response.status == 422) {
                myVar.errorList = error.response.data.error
              }
              if (error.response.status == 404) {
                alert('No user found!')
              }
            } else if (error.request) {
              console.log(error.request)
            } else {
              console.log('Error: ', error.message)
            }
            reject(error);
          }).then(() => {
            if (!Object.keys(this.errorList).length) {
              this.step = 3
            }
          });
      });
    },
    deleteEmployment(id, index) {
      if (!id) {
        this.user.employment.splice(index, 1);
      } else {
        axios.delete(`http://127.0.0.1:8000/api/employment/${id}/delete`)
          .then(response => {
            response
            this.getAllEmploymentDataByUser(this.$route.params.id);
          }).catch(error => {
            console.error('Server error:', error);
            if (error.response && error.response.status === 500) {
              this.errorMessage = 'An error occurred on the server. Please try again later.';
            } else {
              this.errorMessage = 'An error occurred. Please try again.';
            }
          });
      }
      this.errorList = ''
    },
    addEmployment() {
      this.user.employment.push({
        company: '',
        achievements: '',
        role: '',
        type: 'Full-time',
        experience: 0,
        additional_skills: '',
        users_data_id: this.$route.params.id,
        from: '2024-01-01 00:00:00',
        to: '2024-01-01 00:00:00'
      });
    },
    /* EDUCATION DATA*/
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
    updateEducationData() {
      var myVar = this;
      return new Promise((resolve, reject) => {
        axios.put(`http://127.0.0.1:8000/api/education/update`, { educationData: this.user.education })
          .then(response => {
            if (response.data.status === 200) {
              console.log(response.data.message);
              resolve(true);
            }
          }).catch(function (error) {
            if (error.response) {
              if (error.response.status == 422) {
                myVar.errorList = error.response.data.error
              }
              if (error.response.status == 404) {
                alert('No user found!')
              }
            } else if (error.request) {
              console.log(error.request)
            } else {
              console.log('Error: ', error.message)
            }
            reject(error);
          }).then(() => {
            if (!Object.keys(this.errorList).length) {
              this.step = 4
            }
          });
      });
    },
    deleteEducation(id, index) {
      if (!id) {
        this.user.education.splice(index, 1);
      } else {
        axios.delete(`http://127.0.0.1:8000/api/education/${id}/delete`)
          .then(response => {
            response
            this.getAllEducationDataByUser(this.$route.params.id);
          }).catch(error => {
            console.error('Server error:', error);
            if (error.response && error.response.status === 500) {
              this.errorMessage = 'An error occurred on the server. Please try again later.';
            } else {
              this.errorMessage = 'An error occurred. Please try again.';
            }
          });
      }
      this.errorList = ''
    },
    addEducation() {
      this.user.education.push({
        school_name: '',
        faculty: '',
        course: '',
        degree: '',
        status: '',
        users_data_id: this.$route.params.id,
        from: '2024-01-01 00:00:00',
        to: '2024-01-01 00:00:00'
      });
    },
    /* ADDRESS DATA*/
    getAddressData(userId) {
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
    updateAddressData() {
      var myVar = this;
      console.log(this.user.address);
      axios.put(`http://127.0.0.1:8000/api/address/${this.userId}/edit`, this.user.address[0])
        .then(response => {
          response
          this.step = 5

          this.errorList = ''
        }).catch(function (error) {
          if (error.response) {
            if (error.response.status == 422) {
              console.log('Validation errors:', error.response.data.error);
              myVar.errorList = error.response.data.error
            }
            if (error.response.status == 404) {
              alert('No user found!')
            }
          } else if (error.request) {
            console.log(error.request)
          } else {
            console.log('Error: ', error.message)
          }
        })
    }
  }
}
</script>