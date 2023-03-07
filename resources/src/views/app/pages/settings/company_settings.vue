<template>
  <div class="main-content">
    <breadcumb :page="$t('CompanySettings')" :folder="$t('Settings')"/>
    <div v-if="isLoading" class="loading_page spinner spinner-primary mr-3"></div>

    <!-- System Settings -->
    <validation-observer ref="form_setting" v-if="!isLoading">
      <b-form @submit.prevent="Submit_Setting">
        <b-row>
          <b-col lg="12" md="12" sm="12">
            <b-card no-body :header="$t('CompanySettings')">
              <b-card-body>
                <b-row>

                   <!-- Company About Us -->
                  <b-col lg="12" md="12" sm="12">
                    <validation-provider
                      name="AboutUs"
                      :rules="{ required: true}"
                      v-slot="validationContext"
                    >
                      <b-form-group :label="$t('AboutUs')">
                         <textarea
                          :state="getValidationState(validationContext)"
                          aria-describedby="AboutUs-feedback"
                          v-model="setting.AboutUs"
                          class="form-control"
                          :placeholder="$t('Afewwords')"
                         ></textarea>
                        <b-form-invalid-feedback
                          id="AboutUs-feedback"
                        >{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </validation-provider>
                  </b-col>

                   <!-- Company Services -->
                   <b-col lg="12" md="12" sm="12">
                    <validation-provider
                      name="Services"
                      :rules="{ required: true}"
                      v-slot="validationContext"
                    >
                      <b-form-group :label="$t('Services')">
                         <textarea
                          :state="getValidationState(validationContext)"
                          aria-describedby="Services-feedback"
                          v-model="setting.Services"
                          class="form-control"
                          :placeholder="$t('Afewwords')"
                         ></textarea>
                        <b-form-invalid-feedback
                          id="Services-feedback"
                        >{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </validation-provider>
                  </b-col>

                     <!-- Company shipping products -->
                     <b-col lg="12" md="12" sm="12">
                        <validation-provider
                          name="shipping_products"
                          :rules="{ required: true}"
                          v-slot="validationContext"
                        >
                          <b-form-group :label="$t('ShippingProducts')">
                             <textarea
                              :state="getValidationState(validationContext)"
                              aria-describedby="shipping_products-feedback"
                              v-model="setting.shipping_products"
                              class="form-control"
                              :placeholder="$t('Afewwords')"
                             ></textarea>
                            <b-form-invalid-feedback
                              id="shipping_products-feedback"
                            >{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                          </b-form-group>
                        </validation-provider>
                      </b-col>

                        <!-- Company Mediation -->
                <b-col lg="12" md="12" sm="12">
                    <validation-provider
                      name="mediation"
                      :rules="{ required: true}"
                      v-slot="validationContext"
                    >
                      <b-form-group :label="$t('Mediation')">
                         <textarea
                          :state="getValidationState(validationContext)"
                          aria-describedby="mediation-feedback"
                          v-model="setting.mediation"
                          class="form-control"
                          :placeholder="$t('Afewwords')"
                         ></textarea>
                        <b-form-invalid-feedback
                          id="mediation-feedback"
                        >{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                      </b-form-group>
                    </validation-provider>
                  </b-col>


                  <b-col md="12">
                    <b-form-group>
                      <b-button variant="primary" type="submit">{{$t('submit')}}</b-button>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-card-body>
            </b-card>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>



    <!-- Clear Cache -->
      <b-form @submit.prevent="Clear_Cache" v-if="!isLoading">
        <b-row class="mt-5">
          <b-col lg="12" md="12" sm="12">
            <b-card no-body :header="$t('Clear_Cache')">
              <b-card-body>
                <b-row>

                  <b-col md="12">
                    <b-form-group>
                      <b-button variant="primary" @click="Clear_Cache()" >{{$t('Clear_Cache')}}</b-button>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-card-body>
            </b-card>
          </b-col>
        </b-row>
      </b-form>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import NProgress from "nprogress";

export default {
  metaInfo: {
    title: "System Settings"
  },
  data() {
    return {

      isLoading: true,
      data: new FormData(),
      settings: [],
      currencies: [],
      clients: [],
      warehouses: [],
      setting: {
        AboutUs: "",
        Services: "",
        shipping_products: "",
        mediation: "",
        "type_barcode":"",
      },

    };
  },

  methods: {
    ...mapActions(["refreshUserPermissions"]),


      SetLocal(locale) {
      this.$i18n.locale = locale;
      this.$store.dispatch("language/setLanguage", locale);
      Fire.$emit("ChangeLanguage");
    },

    //------------- Submit Validation Setting
    Submit_Setting() {
      this.$refs.form_setting.validate().then(success => {
        if (!success) {
          this.makeToast(
            "danger",
            this.$t("Please_fill_the_form_correctly"),
            this.$t("Failed")
          );
        } else {
          this.Update_Settings();
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

    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },




    //---------------------------------- Update Settings ----------------\\
    Update_Settings() {
      NProgress.start();
      NProgress.set(0.1);
      var self = this;
      self.data.append("AboutUs", self.setting.AboutUs);
      self.data.append("Services", self.setting.Services);
      self.data.append("shipping_products", self.setting.shipping_products);
      self.data.append("mediation", self.setting.mediation);
      self.data.append("_method", "put");

      axios
        .post("company_settings/" + self.setting.id, self.data)
        .then(response => {
          Fire.$emit("Event_Setting");
          this.makeToast(
            "success",
            this.$t("Successfully_Updated"),
            this.$t("Success")
          );
          this.refreshUserPermissions();
          NProgress.done();
        })
        .catch(error => {
          this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
          NProgress.done();
        });
    },



    //---------------------------------- Clear_Cache ----------------\\
    Clear_Cache() {
      NProgress.start();
      NProgress.set(0.1);
      axios
        .get("Clear_Cache")
        .then(response => {
          this.makeToast(
            "success",
            this.$t("Cache_cleared_successfully"),
            this.$t("Success")
          );
          NProgress.done();
        })
        .catch(error => {
          NProgress.done();
          this.makeToast("danger", this.$t("Failed_to_clear_cache"), this.$t("Failed"));
        });
    },


    //---------------------------------- Get SETTINGS ----------------\\
    Get_Settings() {
      axios
        .get("getCompanySettings")
        .then(response => {
          this.setting    = response.data.settings;

          this.isLoading = false;
        })
        .catch(error => {
          setTimeout(() => {
            this.isLoading = false;
          }, 500);
        });
    },






  }, //end Methods

  //----------------------------- Created function-------------------

  created: function() {
    this.Get_Settings();

    Fire.$on("Event_Smtp", () => {
      this.Get_SMTP();
    });

     Fire.$on("Event_payment", () => {
      this.Get_Payment_Gateway();
    });

    Fire.$on("Event_Setting", () => {
      this.Get_Settings();
    });

     Fire.$on("Event_Pos_Settings", () => {
      this.get_pos_Settings();
    });

    Fire.$on("Event_sms", () => {
      this.get_sms_config();
    });
  }
};
</script>
