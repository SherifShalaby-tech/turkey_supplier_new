<template>
  <div class="main-content">
    <breadcumb :page="$t('Edit_Permission')" :folder="$t('Settings')"/>
    <div v-if="isLoading" class="loading_page spinner spinner-primary mr-3"></div>

    <validation-observer ref="Edit_Permission" v-if="!isLoading">
      <b-form @submit.prevent="Submit_Permission">
        <b-row>
          <b-col lg="12" md="12" sm="12">
            <b-card>
              <b-row>
                <!-- Role Name -->
                <b-col md="6">
                  <validation-provider
                    name="Role name"
                    :rules="{ required: true}"
                    v-slot="validationContext"
                  >
                    <b-form-group :label="$t('RoleName')">
                      <b-form-input
                        :placeholder="$t('Enter_Role_Name')"
                        :state="getValidationState(validationContext)"
                        aria-describedby="Role-feedback"
                        v-model="role.name"
                      ></b-form-input>
                      <b-form-invalid-feedback id="Role-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                  </validation-provider>
                </b-col>

                <!-- Role description -->
                <b-col md="6">
                  <b-form-group :label="$t('RoleDescription')">
                    <b-form-input
                      :placeholder="$t('Enter_Role_Description')"
                      v-model="role.description"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>

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
              <b-col md="12">
                <b-button variant="primary" type="submit"  :disabled="SubmitProcessing">{{$t('submit')}}</b-button>
                  <div v-once class="typo__p" v-if="SubmitProcessing">
                    <div class="spinner sm spinner-primary mt-3"></div>
                  </div>
                </b-col>

            </b-card>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </div>
</template>


<script>
import NProgress from "nprogress";

export default {
  metaInfo: {
    title: "Edit Permissions"
  },
  data() {
    return {
      isLoading: true,
      SubmitProcessing:false,
      permissions: [],
      role: {
        name: "",
        description: ""
      }
    };
  },

  methods: {
    //------------- Submit Validation Update Permissions
    Submit_Permission() {
      this.$refs.Edit_Permission.validate().then(success => {
        if (!success) {
          this.makeToast(
            "danger",
            this.$t("Please_fill_the_form_correctly"),
            this.$t("Failed")
          );
        } else {
          this.Update_Permission();
        }
      });
    },

    //---Validate State Fields
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },

    //------ Toast
    makeToast(variant, msg, title) {
      this.$root.$bvToast.toast(msg, {
        title: title,
        variant: variant,
        solid: true
      });
    },

    //------------------------ Update Permissions -------------------\\
    Update_Permission() {
       this.SubmitProcessing = true;
      NProgress.start();
      NProgress.set(0.1);
      let id = this.$route.params.id;
      axios
        .put(`roles/${id}`, {
          role: this.role,
          permissions: this.permissions
        })
        .then(response => {
          this.SubmitProcessing = false;
          NProgress.done();
          this.makeToast(
            "success",
            this.$t("Update.TitleRole"),
            this.$t("Success")
          );

          this.$router.push({ name: "groupPermission" });
          this.$store.dispatch("refreshUserPermissions");
        })
        .catch(error => {
          this.SubmitProcessing = false;
          NProgress.done();
          this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
        });
    },

    //---------------------------------------Get Elements Permission Edit ------------------------------\\
    GetElements() {
      let id = this.$route.params.id;
      axios
        .get(`roles/${id}/edit`)
        .then(response => {
          this.role = response.data.role;
          this.permissions = response.data.permissions;
          this.isLoading = false;
        })
        .catch(response => {
          setTimeout(() => {
            this.isLoading = false;
          }, 500);
        });
    }
  }, //end Methods

  created: function() {
    this.GetElements();
  }
};
</script>
