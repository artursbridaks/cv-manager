<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mt-6" cols="12">
        <h2>New CV</h2>

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
                      <v-text-field counter :maxlength="30" class="ma-0" v-model="person.baseData.name" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Surname:</span>
                      <v-text-field counter :maxlength="30" v-model="person.baseData.surname" outlined
                        dense></v-text-field>
                    </v-col>


                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Email:</span>
                      <v-text-field counter :maxlength="50" v-model="person.baseData.email" outlined dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Phone number:</span>
                      <v-text-field counter :maxlength="8" type="number" v-model="person.baseData.phone_number" outlined
                        dense></v-text-field>
                    </v-col>
                  </div>

                  <!-- Education -->
                  <div v-if="step === 2">

                    <span class="font-weight-medium">Education</span>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">School:</span>
                      <v-text-field counter :maxlength="50" v-model="person.education.schoolName" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Faculty:</span>
                      <v-text-field counter :maxlength="50" v-model="person.education.faculty" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Course:</span>
                      <v-text-field counter :maxlength="50" v-model="person.education.course" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Degree:</span>
                      <v-text-field counter :maxlength="50" v-model="person.education.degree" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Status:</span>
                      <v-combobox clearable outlined :items="['Still studying', 'Graduated', 'Dropped Out', 'Other']">
                      </v-combobox>
                    </v-col>
                  </div>

                  <!-- Employment -->
                  <div v-if="step === 3">

                    <span class="font-weight-medium">Employment</span>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Company:</span>
                      <v-text-field counter :maxlength="50" v-model="person.employment.name" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Role:</span>
                      <v-text-field counter :maxlength="50" v-model="person.employment.role" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Type:</span>
                      <v-combobox clearable outlined :items="['Full-time', 'Part-time', 'Freelance', 'Other']">
                      </v-combobox>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Experience:</span>
                      <v-text-field counter :maxlength="2" v-model="person.employment.experience" type="number" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Achievements:</span>
                      <v-textarea counter :maxlength="200" v-model="person.employment.achievements" outlined
                        dense></v-textarea>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Additional skills:</span>
                      <v-textarea counter :maxlength="200" v-model="person.employment.additionalSkills" outlined
                        dense></v-textarea>
                    </v-col>
                  </div>
                  <!-- Contact information -->
                  <div v-if="step === 4">

                    <span class="font-weight-medium">Contact information</span>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Country:</span>
                      <v-text-field counter :maxlength="100" v-model="person.address.country" outlined
                        dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">City:</span>
                      <v-text-field counter :maxlength="50" v-model="person.address.city" outlined dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Street:</span>
                      <v-text-field counter :maxlength="50" v-model="person.address.street" outlined dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Number:</span>
                      <v-text-field counter :maxlength="10" v-model="person.address.number" outlined dense></v-text-field>
                    </v-col>

                    <v-col class="pa-0 text-left">
                      <span class="font-weight-medium">Index:</span>
                      <v-text-field counter :maxlength="10" v-model="person.address.index" outlined dense></v-text-field>
                    </v-col>
                  </div>
                </v-form>

              </v-col>
            </v-row>


            <v-card-actions class="justify-center">
              <v-btn color="green" outlined @click="nextStep()" exact text>Next</v-btn>
            </v-card-actions>
          </v-card>
        </v-row>

        <v-col class="mb-5" cols="12">
          <v-col class="mb-8">
            <v-btn color="red" to="/home" exact>
              Back
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
  name: 'CreateCV',

  data: () => ({
    errorList: '',
    step: 1,
    person: {
      baseData: {
        name: '',
        surname: '',
        email: '',
        phoneNumber: ''
      },
      education: {
        schoolName: 'RTU',
        faculty: 'Faculty Name',
        course: 'Course Name',
        degree: 'Degree level',
        status: 'Graduated'
      },
      employment: {
        name: 'Company name',
        role: 'Employment role',
        load: 'Full-time',
        experience: 4,
        achievements: 'Achievements',
        additionalSkills: 'Additional skills'
      },
      address: {
        country: 'Country name',
        city: 'City name',
        street: 'Street name',
        number: 'Number',
        index: 'LV-0000'
      }
    }
  }),
  methods: {
    nextStep() {
      if (this.step === 1) {
        this.saveData();
        this.step = 2;
      } else if (this.step === 2) {
        // Save the second section
        this.save();
        // Here you might redirect to another page or reset the form
      }
    },
    saveData() {
      var myVar = this;
      axios.post('http://127.0.0.1:8000/api/users-data', this.person.baseData)
        .then(response => {
          console.log(response)
          this.person.baseData = {
            name: '',
            surname: '',
            phoneNumber: '',
            email: ''
          }

          this.errorList = ''
        }).catch(function (error) {
          if (error.response) {
            if (error.response.status == 422) {
              myVar.errorList = error.response.data.error
            }
          } else if (error.request) {
            console.log(error.request)
          } else {
            console.log('Error: ', error.message)
          }

        })
    }
  },
  computed: {
  }
}
</script>