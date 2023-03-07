<template>
    <div class="main-content">
        <breadcumb :page="$t('AddProduct')" :folder="$t('Products')" />
        <div v-if="isLoading" class="loading_page spinner spinner-primary mr-3"></div>

        <validation-observer ref="Create_Product" v-if="!isLoading">
            <b-form @submit.prevent="Submit_Product" enctype="multipart/form-data">
                <b-row>
                    <b-col md="12">
                        <b-card>
                            <b-row>
                                <!-- Name -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Name" :rules="{ required: true, min: 3, max: 55 }"
                                        v-slot="validationContext">
                                        <b-form-group :label="$t('Name_product')">
                                            <b-form-input :state="getValidationState(validationContext)"
                                                aria-describedby="Name-feedback" label="Name"
                                                :placeholder="$t('Enter_Name_Product')" v-model="product.name">
                                            </b-form-input>
                                            <b-form-invalid-feedback id="Name-feedback">{{ validationContext.errors[0]
                                            }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Code Product"-->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Code Product" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('CodeProduct')">
                                            <div class="input-group">
                                                <b-form-input :class="{ 'is-invalid': !!errors.length }"
                                                    :state="errors[0] ? false : (valid ? true : null)"
                                                    aria-describedby="CodeProduct-feedback" type="text"
                                                    v-model="product.code"></b-form-input>
                                                <b-form-invalid-feedback id="CodeProduct-feedback">{{ errors[0] }}
                                                </b-form-invalid-feedback>
                                            </div>
                                            <span>{{ $t('Scan_your_barcode_and_select_the_correct_symbology_below')
                                            }}</span>
                                            <b-alert show variant="danger" class="error mt-1" v-if="code_exist != ''">
                                                {{ code_exist }}</b-alert>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- OneToTwoUnit"-->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="OneToTwoUnit" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('OneToTwoUnit')">
                                            <div class="input-group">
                                                <b-form-input :class="{ 'is-invalid': !!errors.length }"
                                                    :state="errors[0] ? false : (valid ? true : null)"
                                                    aria-describedby="OneToTwoUnit-feedback" type="text"
                                                    v-model="product.OneToTwoUnit"></b-form-input>
                                                <b-form-invalid-feedback id="OneToTwoUnit-feedback">{{ errors[0] }}
                                                </b-form-invalid-feedback>
                                            </div>

                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- GreaterEqualThreeUnit"-->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="GreaterEqualThreeUnit" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }"
                                            :label="$t('GreaterEqualThreeUnit')">
                                            <div class="input-group">
                                                <b-form-input :class="{ 'is-invalid': !!errors.length }"
                                                    :state="errors[0] ? false : (valid ? true : null)"
                                                    aria-describedby="GreaterEqualThreeUnit-feedback" type="text"
                                                    v-model="product.GreaterEqualThreeUnit"></b-form-input>
                                                <b-form-invalid-feedback id="GreaterEqualThreeUnit-feedback">{{
                                                        errors[0]
                                                }}</b-form-invalid-feedback>
                                            </div>

                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Category -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="category" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('Categorie')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                :reduce="label => label.value" :placeholder="$t('Choose_Category')"
                                                v-model="product.category_id"
                                                :options="categories.map(categories => ({ label: categories.name, value: categories.id }))" />
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Brand  -->
                                <b-col md="6" class="mb-2">
                                    <b-form-group :label="$t('Brand')">
                                        <v-select :placeholder="$t('Choose_Brand')" :reduce="label => label.value"
                                            v-model="product.brand_id"
                                            :options="brands.map(brands => ({ label: brands.name, value: brands.id }))" />
                                    </b-form-group>
                                </b-col>

                                <!-- Barcode Symbology  -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Barcode Symbology" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('BarcodeSymbology')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.Type_barcode" :reduce="label => label.value"
                                                :placeholder="$t('Choose_Symbology')" :options="
                                                [
                                                    { label: 'Code 128', value: 'CODE128' },
                                                    { label: 'Code 39', value: 'CODE39' },
                                                    { label: 'EAN8', value: 'EAN8' },
                                                    { label: 'EAN13', value: 'EAN13' },
                                                    { label: 'UPC', value: 'UPC' },
                                                ]"></v-select>
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Product Cost -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Product Cost"
                                        :rules="{ required: true, regex: /^\d*\.?\d*$/ }" v-slot="validationContext">
                                        <b-form-group :label="$t('ProductCost')">
                                            <b-form-input :state="getValidationState(validationContext)"
                                                aria-describedby="ProductCost-feedback" label="Cost"
                                                :placeholder="$t('Enter_Product_Cost')" v-model="product.cost">
                                            </b-form-input>
                                            <b-form-invalid-feedback id="ProductCost-feedback">{{
                                                    validationContext.errors[0]
                                            }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Product Price -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Product Price"
                                        :rules="{ required: true, regex: /^\d*\.?\d*$/ }" v-slot="validationContext">
                                        <b-form-group :label="$t('ProductPrice')">
                                            <b-form-input :state="getValidationState(validationContext)"
                                                aria-describedby="ProductPrice-feedback" label="Price"
                                                :placeholder="$t('Enter_Product_Price')" v-model="product.price">
                                            </b-form-input>

                                            <b-form-invalid-feedback id="ProductPrice-feedback">{{
                                                    validationContext.errors[0]
                                            }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Unit Product -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Unit Product" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('UnitProduct')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.unit_id" class="required" required
                                                @input="Selected_Unit" :placeholder="$t('Choose_Unit_Product')"
                                                :reduce="label => label.value"
                                                :options="units.map(units => ({ label: units.name, value: units.id }))" />
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Unit Sale -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Unit Sale" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('UnitSale')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.unit_sale_id" :placeholder="$t('Choose_Unit_Sale')"
                                                :reduce="label => label.value"
                                                :options="units_sub.map(units_sub => ({ label: units_sub.name, value: units_sub.id }))" />
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Unit Purchase -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Unit Purchase" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('UnitPurchase')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.unit_purchase_id"
                                                :placeholder="$t('Choose_Unit_Purchase')" :reduce="label => label.value"
                                                :options="units_sub.map(units_sub => ({ label: units_sub.name, value: units_sub.id }))" />
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Companies -->
                                <b-col md="6" class="mb-2" v-if="currentUser.role_id == '2'">
                                    <validation-provider name="company_id" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('companies')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.company_id" :placeholder="$t('Choose_Company')"
                                                :reduce="label => label.value"
                                                :options="companies.map(companies => ({ label: companies.username, value: companies.id }))" />
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Stock Alert -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Stock Alert" :rules="{ regex: /^\d*\.?\d*$/ }"
                                        v-slot="validationContext">
                                        <b-form-group :label="$t('StockAlert')">
                                            <b-form-input :state="getValidationState(validationContext)"
                                                aria-describedby="StockAlert-feedback" label="Stock alert"
                                                :placeholder="$t('Enter_Stock_alert')" v-model="product.stock_alert">
                                            </b-form-input>
                                            <b-form-invalid-feedback id="StockAlert-feedback">{{
                                                    validationContext.errors[0]
                                            }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Order Tax -->
                                <b-col md="6" class="mb-2">
                                    <validation-provider name="Order Tax" :rules="{ regex: /^\d*\.?\d*$/ }"
                                        v-slot="validationContext">
                                        <b-form-group :label="$t('OrderTax')">
                                            <div class="input-group">
                                                <input :state="getValidationState(validationContext)"
                                                    aria-describedby="OrderTax-feedback" v-model="product.TaxNet"
                                                    type="number" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <b-form-invalid-feedback id="OrderTax-feedback">{{
                                                    validationContext.errors[0]
                                            }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <!-- Tax Method -->
                                <b-col lg="6" md="6" sm="12" class="mb-2">
                                    <validation-provider name="Tax Method" :rules="{ required: true }">
                                        <b-form-group slot-scope="{ valid, errors }" :label="$t('TaxMethod')">
                                            <v-select :class="{ 'is-invalid': !!errors.length }"
                                                :state="errors[0] ? false : (valid ? true : null)"
                                                v-model="product.tax_method" :reduce="label => label.value"
                                                :placeholder="$t('Choose_Method')" :options="
                                                [
                                                    { label: 'Exclusive', value: '1' },
                                                    { label: 'Inclusive', value: '2' }
                                                ]"></v-select>
                                            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                </b-col>

                                <b-col md="12" class="mb-2">
                                    <b-form-group :label="$t('Note')">
                                        <textarea rows="4" class="form-control" :placeholder="$t('Afewwords')"
                                            v-model="product.note"></textarea>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                        </b-card>
                    </b-col>
                    <b-col md="8">
                        <!-- upload-multiple-image -->
                        <b-card>
                            <div class="card-header">
                                <h5>{{ $t('EssentialDetails') }}</h5>
                            </div>
                            <div class="card-body">
                                <b-row class="form-group">
                                    <!-- Applicable Industries -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Applicable_Industries"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Applicable_Industries')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Applicable-Industries-feedback"
                                                    label="Applicable_Industries"
                                                    :placeholder="$t('Applicable_Industries')"
                                                    v-model="product.Applicable_Industries"></b-form-input>
                                                <b-form-invalid-feedback id="Applicable-Industries-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Place Origin -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Place_Origin"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Place_Origin')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Place-Origin-feedback"
                                                    label="Applicable_Industries" :placeholder="$t('Place_Origin')"
                                                    v-model="product.Place_Origin"></b-form-input>
                                                <b-form-invalid-feedback id="Place-Origin-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Condition -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Condition"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Condition')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Condition-feedback" label="Condition"
                                                    :placeholder="$t('Condition')" v-model="product.Condition">
                                                </b-form-input>
                                                <b-form-invalid-feedback id="Condition-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Operating Weight -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Operating_Weight"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Operating_Weight')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Operating-Weight-feedback"
                                                    label="Operating_Weight" :placeholder="$t('Operating_Weight')"
                                                    v-model="product.Operating_Weight"></b-form-input>
                                                <b-form-invalid-feedback id="Operating-Weight-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Max_Digging_Height -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Max_Digging_Height"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Max_Digging_Height')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Max-Digging-Height-feedback"
                                                    label="Max_Digging_Height" :placeholder="$t('Max_Digging_Height')"
                                                    v-model="product.Max_Digging_Height"></b-form-input>
                                                <b-form-invalid-feedback id="Max-Digging-Height-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Machine_Weight -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Machine_Weight"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Machine_Weight')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Machine-Weight-feedback" label="Machine_Weight"
                                                    :placeholder="$t('Machine_Weight')"
                                                    v-model="product.Machine_Weight"></b-form-input>
                                                <b-form-invalid-feedback id="Machine-Weight-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                    <!-- Rated_Speed -->
                                    <b-col md="6" class="mb-2">
                                        <validation-provider name="Rated_Speed"
                                            :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                            <b-form-group :label="$t('Rated_Speed')">
                                                <b-form-input :state="getValidationState(validationContext)"
                                                    aria-describedby="Rated-Speed-feedback" label="Rated_Speed"
                                                    :placeholder="$t('Rated_Speed')" v-model="product.Rated_Speed"></b-form-input>

                                                <b-form-invalid-feedback id="Rated-Speed-feedback">{{
                                                        validationContext.errors[0]
                                                }}</b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                    </b-col>

                                        <!-- Power -->
                                        <b-col md="6" class="mb-2">
                                            <validation-provider name="Power"
                                                :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                                <b-form-group :label="$t('Power')">
                                                    <b-form-input :state="getValidationState(validationContext)"
                                                        aria-describedby="Power-feedback" label="Power"
                                                        :placeholder="$t('Power')" v-model="product.Power"></b-form-input>

                                                    <b-form-invalid-feedback id="Power-feedback">{{
                                                            validationContext.errors[0]
                                                    }}</b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                        </b-col>

                                          <!-- Supply_Ability -->
                                        <b-col md="6" class="mb-2">
                                            <validation-provider name="Supply_Ability"
                                                :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                                <b-form-group :label="$t('Supply_Ability')">
                                                    <b-form-input :state="getValidationState(validationContext)"
                                                        aria-describedby="Supply-Ability-feedback" label="Supply_Ability"
                                                        :placeholder="$t('Supply_Ability')" v-model="product.Supply_Ability"></b-form-input>

                                                    <b-form-invalid-feedback id="Supply-Ability-feedback">{{
                                                            validationContext.errors[0]
                                                    }}</b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                        </b-col>

                                             <!-- Packaging -->
                                             <b-col md="6" class="mb-2">
                                                <validation-provider name="Packaging"
                                                    :rules="{ required: true, min: 3, max: 55 }" v-slot="validationContext">
                                                    <b-form-group :label="$t('Packaging')">
                                                        <b-form-input :state="getValidationState(validationContext)"
                                                            aria-describedby="Packaging-feedback" label="Packaging"
                                                            :placeholder="$t('Packaging')" v-model="product.Packaging"></b-form-input>

                                                        <b-form-invalid-feedback id="Packaging-feedback">{{
                                                                validationContext.errors[0]
                                                        }}</b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                            </b-col>


                                </b-row>
                            </div>
                        </b-card>
                    </b-col>
                    <b-col md="4">
                        <!-- upload-multiple-image -->
                        <b-card>
                            <div class="card-header">
                                <h5>{{ $t('MultipleImage') }}</h5>
                            </div>
                            <div class="card-body">
                                <b-row class="form-group">
                                    <b-col md="12 mb-5">
                                        <div id="my-strictly-unique-vue-upload-multiple-image"
                                            class="d-flex justify-content-center">
                                            <vue-upload-multiple-image @upload-success="uploadImageSuccess"
                                                @before-remove="beforeRemove"
                                                dragText="Drag & Drop Multiple images For product"
                                                dropText="Drag & Drop image" browseText="(or) Select"
                                                accept=image/gif,image/jpeg,image/png,image/bmp,image/jpg
                                                primaryText='success' markIsPrimaryText='success'
                                                popupText='have been successfully uploaded' :data-images="images"
                                                idUpload="myIdUpload" :showEdit="false" />
                                        </div>
                                    </b-col>
                                    <!-- Multiple Variants -->
                                    <b-col md="12 mb-2">
                                        <ValidationProvider rules vid="product" v-slot="x">
                                            <div class="form-check">
                                                <label class="checkbox checkbox-outline-primary">
                                                    <input type="checkbox" v-model="product.is_variant">
                                                    <span>{{ $t('ProductHasMultiVariants') }}</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </ValidationProvider>
                                    </b-col>
                                    <b-col md="12 mb-5" v-show="product.is_variant">
                                        <vue-tags-input placeholder="+ add" v-model="tag" :tags="variants"
                                            class="tag-custom text-15" @adding-duplicate="showNotifDuplicate()"
                                            @tags-changed="newTags => variants = newTags" />
                                    </b-col>
                                </b-row>
                            </div>
                        </b-card>
                    </b-col>
                    <b-col md="12" class="mt-3">
                        <b-button variant="primary" type="submit" :disabled="SubmitProcessing">{{ $t('submit') }}
                        </b-button>
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
            SubmitProcessing: false,
            data: new FormData(),
            categories: [],
            units: [],
            companies: [],
            units_sub: [],
            brands: [],
            roles: {},
            variants: [],
            product: {
                name: "",
                code: "",
                OneToTwoUnit: "",
                GreaterEqualThreeUnit: "",
                Packaging : "",
                Place_Origin : "",
                Condition : "",
                Operating_Weight : "",
                Max_Digging_Height : "",
                Machine_Weight : "",
                Rated_Speed : "",
                Power : "",
                Supply_Ability : "",
                Packaging : "",
                Type_barcode: "",
                cost: "",
                price: "",
                brand_id: "",
                category_id: "",
                company_id: "",
                TaxNet: "0",
                tax_method: "1",
                unit_id: "",
                unit_sale_id: "",
                unit_purchase_id: "",
                stock_alert: "0",
                image: "",
                note: "",
                is_variant: false
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
                .get("Products/create")
                .then(response => {
                    this.categories = response.data.categories;
                    this.companies = response.data.companies;
                    this.brands = response.data.brands;
                    this.units = response.data.units;
                    this.isLoading = false;
                })
                .catch(response => {
                    setTimeout(() => {
                        this.isLoading = false;
                    }, 500);
                    this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
                });
        },

        //---------------------- Get Sub Units with Unit id ------------------------------\\
        Get_Units_SubBase(value) {
            axios
                .get("Get_Units_SubBase?id=" + value)
                .then(({ data }) => (this.units_sub = data));
        },

        //---------------------- Event Select Unit Product ------------------------------\\
        Selected_Unit(value) {
            this.units_sub = [];
            this.product.unit_sale_id = "";
            this.product.unit_purchase_id = "";
            this.Get_Units_SubBase(value);
        },

        //------------------------------ Create new Product ------------------------------\\
        Create_Product() {
            // Start the progress bar.
            NProgress.start();
            NProgress.set(0.1);
            var self = this;
            self.SubmitProcessing = true;

            if (self.product.is_variant && self.variants.length <= 0) {
                self.product.is_variant = false;
            }
            // append objet product
            Object.entries(self.product).forEach(([key, value]) => {
                self.data.append(key, value);
            });

            // append array variants
            if (self.variants.length) {
                for (var i = 0; i < self.variants.length; i++) {
                    self.data.append("variants[" + i + "]", self.variants[i].text);
                }
            }
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
                .post("Products", self.data)
                .then(response => {
                    // Complete the animation of theprogress bar.
                    NProgress.done();
                    self.SubmitProcessing = false;
                    this.$router.push({ name: "index_products" });
                    this.makeToast(
                        "success",
                        this.$t("Successfully_Created"),
                        this.$t("Success")
                    );
                })
                .catch(error => {
                    // Complete the animation of theprogress bar.
                    NProgress.done();
                    if (error.errors.code.length > 0) {
                        self.code_exist = error.errors.code[0];
                    }
                    this.makeToast("danger", this.$t("InvalidData"), this.$t("Failed"));
                    self.SubmitProcessing = false;
                });
        }
    }, //end Methods

    //-----------------------------Created function-------------------

    created: function () {
        this.GetElements();
    }
};
</script>
