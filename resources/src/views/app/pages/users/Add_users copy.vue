<template>
  <div class="main-content">
    <breadcumb :page="$t('AddUser')" :folder="$t('Users')"/>
    <div v-if="isLoading" class="loading_page spinner spinner-primary mr-3"></div>

    <validation-observer ref="Create_User" v-if="!isLoading">
        <b-form @submit.prevent="Submit_User" enctype="multipart/form-data">
            <b-row>
              <!-- First name -->
              <b-col md="6" sm="12">
                <validation-provider
                  name="Firstname"
                  :rules="{ required: true , min:3 , max:30}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('Firstname')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="Firstname-feedback"
                      label="Firstname"
                      v-model="user.firstname"
                    ></b-form-input>
                    <b-form-invalid-feedback id="Firstname-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- Last name -->
              <b-col md="6" sm="12">
                <validation-provider
                  name="lastname"
                  :rules="{ required: true , min:3 , max:30}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('lastname')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="lastname-feedback"
                      label="lastname"
                      v-model="user.lastname"
                    ></b-form-input>
                    <b-form-invalid-feedback id="lastname-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- Username -->
              <b-col md="6" sm="12">
                <validation-provider
                  name="username"
                  :rules="{ required: true , min:3 , max:30}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('username')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="username-feedback"
                      label="username"
                      v-model="user.username"
                    ></b-form-input>
                    <b-form-invalid-feedback id="username-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- Phone -->
              <b-col md="6" sm="12">
                <validation-provider
                  name="Phone"
                  :rules="{ required: true}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('Phone')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="Phone-feedback"
                      label="Phone"
                      v-model="user.phone"
                    ></b-form-input>
                    <b-form-invalid-feedback id="Phone-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- Email -->
              <b-col md="6" sm="12">
                <validation-provider
                  name="Email"
                  :rules="{ required: true}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('Email')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="Email-feedback"
                      label="Email"
                      v-model="user.email"
                    ></b-form-input>
                    <b-form-invalid-feedback id="Email-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                    <b-alert
                      show
                      variant="danger"
                      class="error mt-1"
                      v-if="email_exist !=''"
                    >{{email_exist}}</b-alert>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- password -->
              <b-col md="6" sm="12" v-if="!editmode">
                <validation-provider
                  name="password"
                  :rules="{ required: true , min:6 , max:14}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('password')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="password-feedback"
                      label="password"
                      type="password"
                      v-model="user.password"
                    ></b-form-input>
                    <b-form-invalid-feedback id="password-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>

              <!-- role -->
              <b-col md="6" sm="12">
                <validation-provider name="role" :rules="{ required: true}">
                  <b-form-group slot-scope="{ valid, errors }" :label="$t('RoleName')">
                    <v-select
                      :class="{'is-invalid': !!errors.length}"
                      :state="errors[0] ? false : (valid ? true : null)"
                      v-model="user.role_id"
                      :reduce="label => label.value"
                      :placeholder="$t('PleaseSelect')"
                      :options="roles.map(roles => ({label: roles.name, value: roles.id}))"
                    />
                    <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>


                <!-- Type  -->
                <b-col md="6" sm="12">
                    <b-form-group :label="$t('Type')">
                        <v-select
                            v-model="user.type"
                            :reduce="label => label.value"
                            :placeholder="$t('Choose_Status')"
                            :options="
                          [
                             {label: 'Owner', value: '1'},
                             {label: 'Company', value: '2'},

                          ]"
                        ></v-select>
                    </b-form-group>
                </b-col>

              <!-- Avatar -->
              <b-col md="6" sm="12">
                <validation-provider name="Avatar" ref="Avatar" rules="mimes:image/*|size:200">
                  <b-form-group slot-scope="{validate, valid, errors }" :label="$t('UserImage')">
                    <input
                      :state="errors[0] ? false : (valid ? true : null)"
                      :class="{'is-invalid': !!errors.length}"
                      @change="onFileSelected"
                      label="Choose Avatar"
                      type="file"
                    >
                    <b-form-invalid-feedback id="Avatar-feedback">{{ errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>



              <!-- New Password -->
              <b-col md="6">
                <validation-provider
                  name="New password"
                  :rules="{min:6 , max:14}"
                  v-slot="validationContext"
                >
                  <b-form-group :label="$t('Newpassword')">
                    <b-form-input
                      :state="getValidationState(validationContext)"
                      aria-describedby="Nawpassword-feedback"
                      :placeholder="$t('LeaveBlank')"
                      label="New password"
                      v-model="user.NewPassword"
                    ></b-form-input>
                    <b-form-invalid-feedback
                      id="Nawpassword-feedback"
                    >{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                  </b-form-group>
                </validation-provider>
              </b-col>


                <b-col lg="12" md="12" sm="12">
                  <b-card>


                    <b-row class="mt-4">
                      <!--Users -->
                      <b-col md="4">
                        <b-card no-body class="ul-card__border-radius">
                          <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button
                              class="card-title mb-0"
                              block
                              href="#"
                              v-b-toggle.panel-UserManagement
                              variant="transparent"
                            >{{$t('UserManagement')}}</b-button>
                          </b-card-header>
                          <b-collapse
                            id="panel-UserManagement "
                            :visible="true"
                            accordion="my-accordion1"
                            role="tabpanel"
                          >
                            <b-card-body>
                              <b-card-text>
                                <b-row>
                                  <!--Users View -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="users_view"
                                      >
                                      <span>{{$t('View')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Users ADD -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="users_add"
                                      >
                                      <span>{{$t('Add')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Users Edit -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="users_edit"
                                      >
                                      <span>{{$t('Edit')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Users Delete -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="users_delete"
                                      >
                                      <span>{{$t('Del')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Users record view -->
                                  <b-col md="12">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="record_view"
                                      >
                                      <span>{{$t('ShowAll')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                </b-row>
                              </b-card-text>
                            </b-card-body>
                          </b-collapse>
                        </b-card>
                      </b-col>



                      <!--  Permissions -->
                      <b-col md="4">
                        <b-card no-body class="ul-card__border-radius">
                          <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button
                              class="card-title mb-0"
                              block
                              href="#"
                              v-b-toggle.panel-Permissions
                              variant="transparent"
                            >{{$t('UserPermissions')}}</b-button>
                          </b-card-header>
                          <b-collapse
                            id="panel-Permissions "
                            :visible="true"
                            accordion="my-accordion2"
                            role="tabpanel"
                          >
                            <b-card-body>
                              <b-card-text>
                                <b-row>
                                  <!--Permissions View -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="permissions_view"
                                      >
                                      <span>{{$t('View')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Permissions ADD -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="permissions_add"
                                      >
                                      <span>{{$t('Add')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Permissions Edit -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="permissions_edit"
                                      >
                                      <span>{{$t('Edit')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                  <!--Permissions Delete -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="permissions_delete"
                                      >
                                      <span>{{$t('Del')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                </b-row>
                              </b-card-text>
                            </b-card-body>
                          </b-collapse>
                        </b-card>
                      </b-col>

                          <!-- hrm -->
                          <b-col md="4">
                              <b-card no-body class="ul-card__border-radius">
                                <b-card-header header-tag="header" class="p-1" role="tab">
                                  <b-button
                                    class="card-title mb-0"
                                    block
                                    href="#"
                                    v-b-toggle.panel-hrm
                                    variant="transparent"
                                  >{{$t('HRM')}}</b-button>
                                </b-card-header>
                                <b-collapse
                                  id="panel-hrm"
                                  :visible="true"
                                  accordion="my-accordion21"
                                  role="tabpanel"
                                >
                                  <b-card-body>
                                    <b-card-text>
                                      <b-row>
                                         <!--view Employee-->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="view_employee"
                                            >
                                            <span>{{$t('view_employee')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>
                                        <!--add Employee-->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="add_employee"
                                            >
                                            <span>{{$t('Add_Employee')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>
                                        <!--edit employee -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="edit_employee"
                                            >
                                            <span>{{$t('edit_employee')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>
                                         <!--delete employee -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="delete_employee"
                                            >
                                            <span>{{$t('delete_employee')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--Company -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="company"
                                            >
                                            <span>{{$t('Company')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--department -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="department"
                                            >
                                            <span>{{$t('department')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                         <!--designation -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="designation"
                                            >
                                            <span>{{$t('Designation')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--office_shift -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="office_shift"
                                            >
                                            <span>{{$t('Office_Shift')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--attendance -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="attendance"
                                            >
                                            <span>{{$t('Attendance')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--leave -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="leave"
                                            >
                                            <span>{{$t('Leave_request')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                        <!--holiday -->
                                        <b-col md="6">
                                          <label class="checkbox checkbox-outline-primary">
                                            <input
                                              type="checkbox"
                                              checked
                                              v-model="permissions"
                                              value="holiday"
                                            >
                                            <span>{{$t('Holiday')}}</span>
                                            <span class="checkmark"></span>
                                          </label>
                                        </b-col>

                                      </b-row>
                                    </b-card-text>
                                  </b-card-body>
                                </b-collapse>
                              </b-card>
                            </b-col>

                      <!-- Settings -->
                      <b-col md="4">
                        <b-card no-body class="ul-card__border-radius">
                          <b-card-header header-tag="header" class="p-1" role="tab">
                            <b-button
                              class="card-title mb-0"
                              block
                              href="#"
                              v-b-toggle.panel-Settings
                              variant="transparent"
                            >{{$t('Settings')}}</b-button>
                          </b-card-header>
                          <b-collapse
                            id="panel-Settings"
                            :visible="true"
                            accordion="my-accordion18"
                            role="tabpanel"
                          >
                            <b-card-body>
                              <b-card-text>
                                <b-row>
                                  <!--Settings System -->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input
                                        type="checkbox"
                                        checked
                                        v-model="permissions"
                                        value="setting_system"
                                      >
                                      <span>{{$t('SystemSettings')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>

                                  <!--Backup-->
                                  <b-col md="6">
                                    <label class="checkbox checkbox-outline-primary">
                                      <input type="checkbox" checked v-model="permissions" value="backup">
                                      <span>{{$t('Backup')}}</span>
                                      <span class="checkmark"></span>
                                    </label>
                                  </b-col>
                                </b-row>
                              </b-card-text>
                            </b-card-body>
                          </b-collapse>
                        </b-card>
                      </b-col>
                    </b-row>
                    <!-- End row -->



                  </b-card>
                </b-col>

              <b-col md="12" class="mt-3">
                  <b-button variant="primary" type="submit"  :disabled="SubmitProcessing">{{$t('submit')}}</b-button>
                    <div v-once class="typo__p" v-if="SubmitProcessing">
                      <div class="spinner sm spinner-primary mt-3"></div>
                    </div>
              </b-col>

            </b-row>

            <!-- End row -->
          </b-form>
    </validation-observer>
  </div>
</template>


<script>
import VueUploadMultipleImage from "vue-upload-multiple-image";
import VueTagsInput from "@johmun/vue-tags-input";
import NProgress from "nprogress";
import { mapActions, mapGetters } from "vuex";

export default {
  metaInfo: {
    title: "Create Product"
  },
  data() {
    return {
      tag: "",
      len: 8,
      images: [],
      imageArray: [],
      change: false,
      isLoading: true,
      SubmitProcessing:false,
      data: new FormData(),
      categories: [],
      units: [],
      companies: [],
      units_sub: [],
      brands: [],
      roles: [],
      permissions: {},
      variants: [],
      user: {
        firstname: "",
        lastname: "",
        username: "",
        password: "",
        NewPassword: null,
        email: "",
        phone: "",
        statut: "",
        type : "",
        role_id: "",
        avatar: "",
        country: "",
        company_name:"",
        company_Phone : ""
      },
      code_exist: ""
    };
  },

  components: {
    VueUploadMultipleImage,
    VueTagsInput
  },

  computed: {
    ...mapGetters(["currentUser"])
  },

  methods: {
    //------------- Submit Validation Create User
    Submit_User() {
      this.$refs.Create_User.validate().then(success => {
        if (!success) {
          this.makeToast(
            "danger",
            this.$t("Please_fill_the_form_correctly"),
            this.$t("Failed")
          );
        } else {
          if (!this.editmode) {
            this.Create_User();
          } else {
            this.Update_User();
          }
        }
      });
    },

    Check_Create_Page() {
      axios
        .get("roles/check/Create_page")
        .then(response => {
          this.isLoading = false;
        })
        .catch(response => {
          setTimeout(() => {
            this.isLoading = false;
          }, 500);
        });
    },

    //------ Toast
    makeToast(variant, msg, title) {
      this.$root.$bvToast.toast(msg, {
        title: title,
        variant: variant,
        solid: true
      });
    },

    //------ Validation State
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },

    //------Show Notification If Variant is Duplicate
    showNotifDuplicate() {
      this.makeToast(
        "warning",
        this.$t("VariantDuplicate"),
        this.$t("Warning")
      );
    },

    //------ Event upload Image Success
    uploadImageSuccess(formData, index, fileList, imageArray) {
      this.images = fileList;
    },

    //------ Event before Remove Image
    beforeRemove(index, done, fileList) {
      var remove = confirm("remove image");
      if (remove == true) {
        this.images = fileList;
        done();
      } else {
      }
    },

    //-------------- Product Get Elements
    GetElements() {
      axios
        .get("users/create")
        .then(response => {
            this.roles = response.data.roles;
          this.isLoading = false;
        })
        .catch(response => {
          setTimeout(() => {
            this.isLoading = false;
          }, 500);
          this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
        });
    },



    //------------------------ Create User ---------------------------\\
    Create_User() {
      var self = this;
      self.SubmitProcessing = true;
      self.data.append("firstname", self.user.firstname);
      self.data.append("lastname", self.user.lastname);
      self.data.append("username", self.user.username);
      self.data.append("email", self.user.email);
      self.data.append("password", self.user.password);
      self.data.append("phone", self.user.phone);
      self.data.append("role", self.user.role_id);
      self.data.append("avatar", self.user.avatar);
        self.data.append("type", self.user.type);

      axios
        .post("users", self.data)
        .then(response => {
          self.SubmitProcessing = false;
          Fire.$emit("Event_User");

          this.makeToast(
            "success",
            this.$t("Create.TitleUser"),
            this.$t("Success")
          );
        })
        .catch(error => {
          self.SubmitProcessing = false;
          if (error.errors.email.length > 0) {
            self.email_exist = error.errors.email[0];
          }
          this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
        });
    },
  }, //end Methods

  //-----------------------------Created function-------------------

  created: function() {
    this.Check_Create_Page();
    this.GetElements();
    Fire.$on("Event_User", () => {
      setTimeout(() => {
        this.GetElements();
      }, 500);
    });

    Fire.$on("Delete_User", () => {
      setTimeout(() => {
        this.GetElements();
      }, 500);
    });
  }
};
</script>
