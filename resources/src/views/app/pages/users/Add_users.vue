<template>
    <div class="main-content">
      <breadcumb :page="$t('AddUser')" :folder="$t('Users')"/>
      <div v-if="isLoading" class="loading_page spinner spinner-primary mr-3"></div>

      <validation-observer ref="Create_Product" v-if="!isLoading">
        <b-form @submit.prevent="Submit_Product" enctype="multipart/form-data">
          <b-row>
            <b-col md="12">
              <b-card>
                <b-row>
                  <!-- firstname -->
                  <b-col md="3" class="mb-2">
                    <validation-provider
                      name="firstname"
                      :rules="{required:true , min:3 , max:55}"
                      v-slot="validationContext"
                    >
                      <b-form-group :label="$t('firstname')">
                        <b-form-input
                          :state="getValidationState(validationContext)"
                          aria-describedby="firstname-feedback"
                          label="firstname"
                          :placeholder="$t('Enter_Name_Product')"
                          v-model="user.firstname"
                        ></b-form-input>
                        <b-form-invalid-feedback id="firstname-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </validation-provider>
                  </b-col>

                     <!-- lastname -->
                     <b-col md="3" class="mb-2">
                        <validation-provider
                          name="lastname"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('lastname')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="lastname-feedback"
                              label="lastname"
                              :placeholder="$t('Enter_lastname')"
                              v-model="user.lastname"
                            ></b-form-input>
                            <b-form-invalid-feedback id="lastname-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                     <!-- username -->
                     <b-col md="3" class="mb-2">
                        <validation-provider
                          name="username"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('username')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="username-feedback"
                              label="username"
                              :placeholder="$t('Enter_username')"
                              v-model="user.username"
                            ></b-form-input>
                            <b-form-invalid-feedback id="username-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                 <!-- Phone -->
              <b-col md="3" sm="12">
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
              <b-col md="3" sm="12">
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

                 <!-- country -->
                 <b-col md="3" class="mb-2">
                    <validation-provider
                      name="country"
                      :rules="{required:true , min:3 , max:55}"
                      v-slot="validationContext"
                    >
                      <b-form-group :label="$t('country')">
                        <b-form-input
                          :state="getValidationState(validationContext)"
                          aria-describedby="country-feedback"
                          label="country"
                          :placeholder="$t('country')"
                          v-model="user.country"
                        ></b-form-input>
                        <b-form-invalid-feedback id="country-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </validation-provider>
                  </b-col>

              <!-- password -->
              <b-col md="3" sm="12">
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
                <b-col md="3" sm="12">
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

                     <!-- companyname -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="companyname"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('companyname')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="companyname-feedback"
                              label="companyname"
                              :placeholder="$t('Enter_companyname')"
                              v-model="user.companyname"
                            ></b-form-input>
                            <b-form-invalid-feedback id="companyname-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                       <!-- companyphone -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="companyphone"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('companyphone')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="companyphone-feedback"
                              label="companyphone"
                              :placeholder="$t('companyphone')"
                              v-model="user.companyphone"
                            ></b-form-input>
                            <b-form-invalid-feedback id="companyphone-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                        <!-- companycountry -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="companycountry"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('companycountry')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="companycountry-feedback"
                              label="companycountry"
                              :placeholder="$t('companycountry')"
                              v-model="user.companycountry"
                            ></b-form-input>
                            <b-form-invalid-feedback id="companycountry-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                       <!-- business_type -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="businesstype"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('business_type')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="businesstype-feedback"
                              label="businesstype"
                              :placeholder="$t('business_type')"
                              v-model="user.business_type"
                            ></b-form-input>
                            <b-form-invalid-feedback id="businesstype-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                       <!-- country_Region -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="countryRegion"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('countryRegion')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="countryRegion-feedback"
                              label="countryRegion"
                              :placeholder="$t('countryRegion')"
                              v-model="user.country_Region"
                            ></b-form-input>
                            <b-form-invalid-feedback id="countryRegion-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                       <!-- main_products -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="mainproducts"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('mainproducts')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="mainproducts-feedback"
                              label="mainproducts"
                              :placeholder="$t('mainproducts')"
                              v-model="user.main_products"
                            ></b-form-input>
                            <b-form-invalid-feedback id="mainproducts-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                       <!-- total_employee -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="totalemployee"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('totalemployee')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="totalemployee-feedback"
                              label="totalemployee"
                              :placeholder="$t('totalemployee')"
                              v-model="user.total_employee"
                            ></b-form-input>
                            <b-form-invalid-feedback id="totalemployee-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                         <!-- major_clients -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="majorclients"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('majorclients')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="majorclients-feedback"
                              label="majorclients"
                              :placeholder="$t('majorclients')"
                              v-model="user.major_clients"
                            ></b-form-input>
                            <b-form-invalid-feedback id="majorclients-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                         <!-- certifications -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="certifications"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('certifications')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="certifications-feedback"
                              label="certifications"
                              :placeholder="$t('certifications')"
                              v-model="user.certifications"
                            ></b-form-input>
                            <b-form-invalid-feedback id="certifications-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                          <!-- product_certifications -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="productcertifications"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('productcertifications')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="productcertifications-feedback"
                              label="productcertifications"
                              :placeholder="$t('productcertifications')"
                              v-model="user.product_certifications"
                            ></b-form-input>
                            <b-form-invalid-feedback id="productcertifications-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                           <!-- patents -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="patents"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('patents')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="patents-feedback"
                              label="patents"
                              :placeholder="$t('patents')"
                              v-model="user.patents"
                            ></b-form-input>
                            <b-form-invalid-feedback id="patents-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                                  <!-- trademarks -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="trademarks"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('trademarks')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="trademarks-feedback"
                              label="trademarks"
                              :placeholder="$t('trademarks')"
                              v-model="user.trademarks"
                            ></b-form-input>
                            <b-form-invalid-feedback id="trademarks-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                                 <!-- main_markets -->
                     <b-col md="3" class="mb-2" v-if="user.role_id == '2'">
                        <validation-provider
                          name="mainmarkets"
                          :rules="{required:true , min:3 , max:55}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('mainmarkets')">
                            <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="mainmarkets-feedback"
                              label="mainmarkets"
                              :placeholder="$t('mainmarkets')"
                              v-model="user.main_markets"
                            ></b-form-input>
                            <b-form-invalid-feedback id="mainmarkets-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>


                    <!-- trade_role  -->
                <b-col md="3" sm="12">
                    <b-form-group :label="$t('trade_role')">
                        <v-select
                            v-model="user.trade_role"
                            :reduce="label => label.value"
                            :placeholder="$t('Choose_trade_role')"
                            :options="
                          [
                             {label: 'Buyer', value: 'Buyer '},
                             {label: 'seller', value: 'seller'},
                             {label: 'both', value: 'both'},

                          ]"
                        ></v-select>
                    </b-form-group>
                </b-col>

                <b-col md="6" class="mb-2">
                    <b-form-group :label="$t('production_process')">
                      <textarea
                        rows="4"
                        class="form-control"
                        :placeholder="$t('production_process')"
                        v-model="user.production_process"
                      ></textarea>
                    </b-form-group>
                  </b-col>



                <b-col lg="12" md="12" sm="12" v-if="user.role_id == '1'">
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                          v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                                v-model="user.permissions"
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
                                          v-model="user.permissions"
                                          value="setting_system"
                                        >
                                        <span>{{$t('SystemSettings')}}</span>
                                        <span class="checkmark"></span>
                                      </label>
                                    </b-col>

                                    <!--Backup-->
                                    <b-col md="6">
                                      <label class="checkbox checkbox-outline-primary">
                                        <input type="checkbox" checked v-model="user.permissions" value="backup">
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

                </b-row>
              </b-card>
            </b-col>
            <b-col md="4" v-if="user.role_id == '2'">
              <!-- upload-multiple-image -->
              <b-card>
                <div class="card-header">
                  <h5>{{$t('MultipleImage')}}</h5>
                </div>
                <div class="card-body">
                  <b-row class="form-group">
                    <b-col md="12 mb-5">
                      <div
                        id="my-strictly-unique-vue-upload-multiple-image"
                        class="d-flex justify-content-center"
                      >
                        <vue-upload-multiple-image
                        @upload-success="uploadImageSuccess"
                        @before-remove="beforeRemove"
                        dragText="Drag & Drop Multiple images For company"
                        dropText="Drag & Drop image"
                        browseText="(or) Select"
                        accept=image/gif,image/jpeg,image/png,image/bmp,image/jpg
                        primaryText='success'
                        markIsPrimaryText='success'
                        popupText='have been successfully uploaded'
                        :data-images="images"
                        idUpload="myIdUpload"
                        :showEdit="false"
                        />
                      </div>
                    </b-col>
                  </b-row>
                </div>
              </b-card>
            </b-col>
            <b-col md="12" class="mt-3">
               <b-button variant="primary" type="submit" :disabled="SubmitProcessing">{{$t('submit')}}</b-button>
                <div v-once class="typo__p" v-if="SubmitProcessing">
                  <div class="spinner sm spinner-primary mt-3"></div>
                </div>
            </b-col>
          </b-row>
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
      title: "Create User"
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

        roles: [],
        user: {
        firstname: "",
        lastname: "",
        username: "",
        password: "",
        NewPassword: null,
        email: "",
        phone: "",
        statut: "",
        role_id: "",
        trade_role : "",
        images: "",
        country: "",
        company_name:"",
        company_Phone : "",
        production_process : "",
        permissions: [],
        business_type : "",
        country_Region : "",
        main_products : "",
        total_employee : "",
        major_clients : "",
        certifications : "",
        product_certifications : "",
        patents : "",
        trademarks : "",
        main_markets : "",
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
      //------------- Submit Validation Create Product
      Submit_Product() {
        this.$refs.Create_Product.validate().then(success => {
          if (!success) {
            this.makeToast(
              "danger",
              this.$t("Please_fill_the_form_correctly"),
              this.$t("Failed")
            );
          } else {
            this.Create_Product();
          }
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


      //------------------------------ Create new Product ------------------------------\\
      Create_Product() {
        // Start the progress bar.
        NProgress.start();
        NProgress.set(0.1);
        var self = this;
        self.SubmitProcessing = true;

        // append objet product
        Object.entries(self.user).forEach(([key, value]) => {
          self.data.append(key, value);
        });


        //append array images
        if (self.images.length > 0) {
          for (var k = 0; k < self.images.length; k++) {
            Object.entries(self.images[k]).forEach(([key, value]) => {
              self.data.append("images[" + k + "][" + key + "]", value);
            });
          }
        }

        // Send Data with axios
        axios
          .post("users", self.data)
          .then(response => {
            // Complete the animation of theprogress bar.
            NProgress.done();
            self.SubmitProcessing = false;
            this.$router.push({ name: "index_users" });
            this.makeToast(
              "success",
              this.$t("Successfully_Created"),
              this.$t("Success")
            );
          })
          .catch(error => {
            // Complete the animation of theprogress bar.
            NProgress.done();

            this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
            self.SubmitProcessing = false;
          });
      }
    }, //end Methods

    //-----------------------------Created function-------------------

    created: function() {
      this.GetElements();
    }
  };
  </script>
