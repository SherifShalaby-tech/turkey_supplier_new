import Vue from "vue";
import store from "./store";
import Router from "vue-router";
import {
    i18n
} from "./plugins/i18n";
import authenticate from "./auth/authenticate";
import IsConnected from "./auth/IsConnected";

import NProgress from "nprogress";

Vue.use(Router);

// create new router

const routes = [{
        path: "/",
        component: () => import("./views/app"),
        // beforeEnter: authenticate,
        redirect: "/admin/app/dashboard",

        children: [{
                path: "/admin/app/dashboard",
                name: "dashboard",
                component: () => import( /* webpackChunkName: "dashboard" */ "./views/app/dashboard/dashboard")
            },

            //Products
            {
                path: "/admin/app/products",
                component: () => import( /* webpackChunkName: "products" */ "./views/app/pages/products"),
                redirect: "/admin/app/products/list",
                children: [{
                        name: "index_products",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_products" */ "./views/app/pages/products/index_products")
                    },
                    {
                        path: "store",
                        name: "store_product",
                        component: () =>
                            import( /* webpackChunkName: "store_product" */ "./views/app/pages/products/Add_product")
                    },
                    {
                        path: "edit/:id",
                        name: "edit_product",
                        component: () =>
                            import( /* webpackChunkName: "edit_product" */ "./views/app/pages/products/Edit_product")
                    },
                    {
                        path: "detail/:id",
                        name: "detail_product",
                        component: () =>
                            import( /* webpackChunkName: "detail_product" */ "./views/app/pages/products/Detail_Product")
                    },
                    {
                        path: "barcode",
                        name: "barcode",
                        component: () =>
                            import( /* webpackChunkName: "barcode" */ "./views/app/pages/products/barcode")
                    },
                ]
            },

            //Users
            {
                path: "/admin/app/users",
                component: () => import( /* webpackChunkName: "users" */ "./views/app/pages/users"),
                redirect: "/admin/app/users/list",
                children: [{
                        name: "index_users",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_users" */ "./views/app/pages/users/index_users")
                    },
                    {
                        path: "store",
                        name: "store_user",
                        component: () =>
                            import( /* webpackChunkName: "store_user" */ "./views/app/pages/users/Add_users")
                    },
                    {
                        path: "edit/:id",
                        name: "edit_user",
                        component: () =>
                            import( /* webpackChunkName: "edit_user" */ "./views/app/pages/users/Edit_user")
                    },
                    {
                        path: "detail/:id",
                        name: "detail_user",
                        component: () =>
                            import( /* webpackChunkName: "detail_user" */ "./views/app/pages/users/Detail_User")
                    },

                ]
            },

            //Adjustement
            {
                path: "/admin/app/adjustments",
                component: () => import( /* webpackChunkName: "adjustments" */ "./views/app/pages/adjustment"),
                redirect: "/admin/app/adjustments/list",
                children: [{
                        name: "index_adjustment",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_adjustment" */
                                "./views/app/pages/adjustment/index_Adjustment"
                            )
                    },
                    {
                        name: "store_adjustment",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_adjustment" */
                                "./views/app/pages/adjustment/Create_Adjustment"
                            )
                    },
                    {
                        name: "edit_adjustment",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_adjustment" */
                                "./views/app/pages/adjustment/Edit_Adjustment"
                            )
                    }
                ]
            },

            //Transfer
            {
                path: "/admin/app/transfers",
                component: () => import( /* webpackChunkName: "transfers" */ "./views/app/pages/transfers"),
                redirect: "/admin/app/transfers/list",
                children: [{
                        name: "index_transfer",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_transfer" */ "./views/app/pages/transfers/index_transfer")
                    },
                    {
                        name: "store_transfer",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_transfer" */
                                "./views/app/pages/transfers/create_transfer"
                            )
                    },
                    {
                        name: "edit_transfer",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_transfer" */ "./views/app/pages/transfers/edit_transfer")
                    }
                ]
            },

            //Expense
            {
                path: "/admin/app/expenses",
                component: () => import( /* webpackChunkName: "expenses" */ "./views/app/pages/expense"),
                redirect: "/admin/app/expenses/list",
                children: [{
                        name: "index_expense",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_expense" */ "./views/app/pages/expense/index_expense")
                    },
                    {
                        name: "store_expense",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_expense" */ "./views/app/pages/expense/Create_expense")
                    },
                    {
                        name: "edit_expense",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_expense" */ "./views/app/pages/expense/Edit_expense")
                    },
                    {
                        name: "expense_category",
                        path: "category",
                        component: () =>
                            import( /* webpackChunkName: "expense_category" */ "./views/app/pages/expense/category_expense")
                    }
                ]
            },

            //Shipment Orders
            {
                path: "/admin/app/shipment_orders",
                component: () => import( /* webpackChunkName: "expenses" */ "./views/app/pages/shipment_orders"),
                redirect: "/admin/app/shipment_orders/list",
                children: [{
                        name: "index_shipment_orders",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_expense" */ "./views/app/pages/shipment_orders/index_shipment_orders")
                    },

                ]
            },

            //Complains
            {
                path: "/admin/app/complains",
                component: () => import( /* webpackChunkName: "complains" */ "./views/app/pages/complains"),
                redirect: "/admin/app/complains/list",
                children: [{
                        name: "index_complains",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_complains" */ "./views/app/pages/complains/index_Complains")
                    },

                ]
            },

              //SupportChats
              {
                path: "/admin/app/support_chats",
                component: () => import( /* webpackChunkName: "support_chats" */ "./views/app/pages/support_chat"),
                redirect: "/admin/app/support_chats/list",
                children: [{
                        name: "index_support_chats",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_support_chats" */ "./views/app/pages/support_chat/index_Support_Chat")
                    },

                ]
            },

            //Quotation
            {
                path: "/admin/app/quotations",
                component: () => import( /* webpackChunkName: "quotations" */ "./views/app/pages/quotations"),
                redirect: "/admin/app/quotations/list",
                children: [{
                        name: "index_quotation",
                        path: "list",
                        component: () =>
                            import(
                                "./views/app/pages/quotations/index_quotation"
                            )
                    },
                    {
                        name: "store_quotation",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_quotation" */
                                "./views/app/pages/quotations/create_quotation"
                            )
                    },
                    {
                        name: "edit_quotation",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_quotation" */
                                "./views/app/pages/quotations/edit_quotation"
                            )
                    },
                    {
                        name: "detail_quotation",
                        path: "detail/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_quotation" */
                                "./views/app/pages/quotations/detail_quotation"
                            )
                    },
                    {
                        name: "change_to_sale",
                        path: "create_sale/:id",
                        component: () =>
                            import( /* webpackChunkName: "change_to_sale" */ "./views/app/pages/sales/change_to_sale.vue")
                    },

                ]
            },

            //Purchase
            {
                path: "/admin/app/purchases",
                component: () => import( /* webpackChunkName: "purchases" */ "./views/app/pages/purchases"),
                redirect: "/admin/app/purchases/list",
                children: [{
                        name: "index_purchases",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_purchases" */ "./views/app/pages/purchases/index_purchase")
                    },
                    {
                        name: "store_purchase",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_purchase" */
                                "./views/app/pages/purchases/create_purchase"
                            )
                    },
                    {
                        name: "edit_purchase",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_purchase" */ "./views/app/pages/purchases/edit_purchase")
                    },
                    {
                        name: "detail_purchase",
                        path: "detail/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_purchase" */
                                "./views/app/pages/purchases/detail_purchase"
                            )
                    }
                ]
            },

            //Sale
            {
                path: "/admin/app/sales",
                component: () => import( /* webpackChunkName: "sales" */ "./views/app/pages/sales"),
                redirect: "/admin/app/sales/list",
                children: [{
                        name: "index_sales",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_sales" */ "./views/app/pages/sales/index_sale")
                    },
                    {
                        name: "store_sale",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_sale" */ "./views/app/pages/sales/create_sale")
                    },
                    {
                        name: "edit_sale",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_sale" */ "./views/app/pages/sales/edit_sale")
                    },
                    {
                        name: "detail_sale",
                        path: "detail/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_sale" */ "./views/app/pages/sales/detail_sale")
                    }
                ]
            },

            // Sales Return
            {
                path: "/admin/app/sale_return",
                component: () => import( /* webpackChunkName: "sale_return" */ "./views/app/pages/sale_return"),
                redirect: "/admin/app/sale_return/list",
                children: [{
                        name: "index_sale_return",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_sale_return" */
                                "./views/app/pages/sale_return/index_sale_return"
                            )
                    },
                    {
                        name: "store_sale_return",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_sale_return" */
                                "./views/app/pages/sale_return/create_sale_return"
                            )
                    },
                    {
                        name: "edit_sale_return",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_sale_return" */
                                "./views/app/pages/sale_return/edit_sale_return"
                            )
                    },
                    {
                        name: "detail_sale_return",
                        path: "detail/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_sale_return" */
                                "./views/app/pages/sale_return/detail_sale_return"
                            )
                    }
                ]
            },

            // purchase Return
            {
                path: "/admin/app/purchase_return",
                component: () => import( /* webpackChunkName: "purchase_return" */ "./views/app/pages/purchase_return"),
                redirect: "/admin/app/purchase_return/list",
                children: [{
                        name: "index_purchase_return",
                        path: "list",
                        component: () =>
                            import( /* webpackChunkName: "index_purchase_return" */
                                "./views/app/pages/purchase_return/index_purchase_return"
                            )
                    },
                    {
                        name: "store_purchase_return",
                        path: "store",
                        component: () =>
                            import( /* webpackChunkName: "store_purchase_return" */
                                "./views/app/pages/purchase_return/create_purchase_return"
                            )
                    },
                    {
                        name: "edit_purchase_return",
                        path: "edit/:id",
                        component: () =>
                            import( /* webpackChunkName: "edit_purchase_return" */
                                "./views/app/pages/purchase_return/edit_purchase_return"
                            )
                    },
                    {
                        name: "detail_purchase_return",
                        path: "detail/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_purchase_return" */
                                "./views/app/pages/purchase_return/detail_purchase_return"
                            )
                    }
                ]
            },

            // People
            {
                path: "/admin/app/People",
                component: () => import( /* webpackChunkName: "People" */ "./views/app/pages/people"),
                redirect: "/admin/app/People/Customers",
                children: [
                    // Customers
                    {
                        name: "Customers",
                        path: "Customers",
                        component: () =>
                            import( /* webpackChunkName: "Customers" */ "./views/app/pages/people/customers")
                    },

                    // Suppliers
                    {
                        name: "Suppliers",
                        path: "Suppliers",
                        component: () =>
                            import( /* webpackChunkName: "Suppliers" */ "./views/app/pages/people/providers")
                    },


                ]
            },

            // Settings
            {
                path: "/admin/app/settings",
                component: () => import( /* webpackChunkName: "settings" */ "./views/app/pages/settings"),
                redirect: "/admin/app/settings/System_settings",
                children: [
                    // Permissions
                    {
                        path: "permissions",
                        component: () =>
                            import( /* webpackChunkName: "permissions" */ "./views/app/pages/settings/permissions"),
                        redirect: "/admin/app/settings/permissions/list",
                        children: [{
                                name: "groupPermission",
                                path: "list",
                                component: () =>
                                    import( /* webpackChunkName: "groupPermission" */
                                        "./views/app/pages/settings/permissions/Permissions"
                                    )
                            },
                            {
                                name: "store_permission",
                                path: "store",
                                component: () =>
                                    import( /* webpackChunkName: "store_permission" */
                                        "./views/app/pages/settings/permissions/Create_permission"
                                    )
                            },
                            {
                                name: "edit_permission",
                                path: "edit/:id",
                                component: () =>
                                    import( /* webpackChunkName: "edit_permission" */
                                        "./views/app/pages/settings/permissions/Edit_permission"
                                    )
                            }
                        ]
                    },

                    // Hrm
                    {
                        path: "/admin/app/hrm",
                        component: () =>
                            import(
                                /* webpackChunkName: "hrm" */
                                "./views/app/pages/hrm"
                            ),
                        redirect: "/admin/app/hrm/employees",
                        children: [
                            // employees
                            {
                                path: "employees",
                                component: () =>
                                    import(
                                        /* webpackChunkName: "employees" */
                                        "./views/app/pages/hrm/employees"
                                    ),
                                redirect: "/admin/app/hrm/employees/list",
                                children: [{
                                        name: "employees_list",
                                        path: "list",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "index_employee" */
                                                "./views/app/pages/hrm/employees/index_employee"
                                            )
                                    },
                                    {
                                        name: "store_employee",
                                        path: "store",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "store_employee" */
                                                "./views/app/pages/hrm/employees/employee_create"
                                            )
                                    },
                                    {
                                        name: "edit_employee",
                                        path: "edit/:id",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "edit_employee" */
                                                "./views/app/pages/hrm/employees/employee_edit"
                                            )
                                    },
                                    {
                                        name: "detail_employee",
                                        path: "detail/:id",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "detail_employee" */
                                                "./views/app/pages/hrm/employees/employee_details"
                                            )
                                    },
                                ]
                            },
                            // company
                            {
                                name: "company",
                                path: "company",
                                component: () =>
                                    import( /* webpackChunkName: "company" */ "./views/app/pages/people/companies")
                            },

                            // departments
                            {
                                name: "departments",
                                path: "departments",
                                component: () =>
                                    import( /* webpackChunkName: "departments" */ "./views/app/pages/hrm/department")
                            },

                            // designations
                            {
                                name: "designations",
                                path: "designations",
                                component: () =>
                                    import( /* webpackChunkName: "designations" */ "./views/app/pages/hrm/designation")
                            },

                            // office_shift
                            {
                                name: "office_shift",
                                path: "office_shift",
                                component: () =>
                                    import( /* webpackChunkName: "office_shift" */ "./views/app/pages/hrm/office_shift")
                            },

                            // attendance
                            {
                                name: "attendance",
                                path: "attendance",
                                component: () =>
                                    import( /* webpackChunkName: "attendance" */ "./views/app/pages/hrm/attendance")
                            },

                            // holidays
                            {
                                name: "holidays",
                                path: "holidays",
                                component: () =>
                                    import( /* webpackChunkName: "holidays" */ "./views/app/pages/hrm/holidays")
                            },


                            {
                                path: "leaves",
                                component: () =>
                                    import(
                                        /* webpackChunkName: "leaves" */
                                        "./views/app/pages/hrm/leaves"
                                    ),
                                redirect: "/admin/app/hrm/leaves/list",
                                children: [{
                                        name: "leave_list",
                                        path: "list",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "leave_list" */
                                                "./views/app/pages/hrm/leaves/leave_list"
                                            )
                                    },
                                    {
                                        name: "leave_type",
                                        path: "type",
                                        component: () =>
                                            import(
                                                /* webpackChunkName: "leave_type" */
                                                "./views/app/pages/hrm/leaves/leave_type"
                                            )
                                    },

                                ]
                            },


                        ]
                    },

                    // languages
                    {
                        name: "languages",
                        path: "Languages",
                        component: () =>
                            import( /* webpackChunkName: "languages" */ "./views/app/pages/settings/languages")
                    },

                    // subscribes
                    {
                        name: "subscribes",
                        path: "subscribes",
                        component: () =>
                            import( /* webpackChunkName: "subscribes" */ "./views/app/pages/settings/subscribes")
                    },

                    // categories
                    {
                        name: "categories",
                        path: "Categories",
                        component: () =>
                            import( /* webpackChunkName: "Categories" */ "./views/app/pages/settings/categorie")
                    },

                    // sub_categories
                    {
                        name: "sub_categories",
                        path: "sub_categories",
                        component: () =>
                            import( /* webpackChunkName: "sub_categories" */ "./views/app/pages/settings/sub_category")
                    },


                    // brands
                    {
                        name: "brands",
                        path: "Brands",
                        component: () =>
                            import( /* webpackChunkName: "Brands" */ "./views/app/pages/settings/brands")
                    },
                    // shipment_services
                    {
                        name: "shipment_services",
                        path: "shipment_services",
                        component: () =>
                            import( /* webpackChunkName: "shipment_services" */ "./views/app/pages/settings/shipment_services")
                    },

                    // Ads
                    {
                        name: "ads",
                        path: "Ads",
                        component: () =>
                            import( /* webpackChunkName: "Ads" */ "./views/app/pages/settings/ads")
                    },

                       // Trade Show
                       {
                        name: "trade_show",
                        path: "trade_show",
                        component: () =>
                            import( /* webpackChunkName: "trade_show" */ "./views/app/pages/settings/trade_show")
                    },

                         // Translation Services
                         {
                            name: "translation_services",
                            path: "translation_services",
                            component: () =>
                                import( /* webpackChunkName: "translation_services" */ "./views/app/pages/settings/translation_services")
                        },

                         // meditations
                         {
                            name: "meditations",
                            path: "meditations",
                            component: () =>
                                import( /* webpackChunkName: "meditations" */ "./views/app/pages/settings/meditations")
                        },


                    // currencies
                    {
                        name: "currencies",
                        path: "Currencies",
                        component: () =>
                            import( /* webpackChunkName: "Currencies" */ "./views/app/pages/settings/currencies")
                    },

                    // units
                    {
                        name: "units",
                        path: "Units",
                        component: () =>
                            import( /* webpackChunkName: "units" */ "./views/app/pages/settings/units")
                    },

                    // units
                    {
                        name: "packages",
                        path: "packages",
                        component: () =>
                            import( /* webpackChunkName: "packages" */ "./views/app/pages/settings/packages")
                    },

                    // Backup
                    {
                        name: "Backup",
                        path: "Backup",
                        component: () =>
                            import( /* webpackChunkName: "Backup" */ "./views/app/pages/settings/backup")
                    },

                    // Warehouses
                    {
                        name: "Warehouses",
                        path: "Warehouses",
                        component: () =>
                            import( /* webpackChunkName: "Warehouses" */ "./views/app/pages/settings/warehouses")
                    },

                    // System Settings
                    {
                        name: "system_settings",
                        path: "System_settings",
                        component: () =>
                            import( /* webpackChunkName: "System_settings" */ "./views/app/pages/settings/system_settings")
                    },
                    // updates
                    //  {
                    //     name: "updates",
                    //     path: "updates",
                    //     component: () =>
                    //         import(/* webpackChunkName: "updates" */"./views/app/pages/settings/updates")
                    // }
                ]
            },

            //company_Settings
            {
                path: "/admin/app/company_Settings",
                component: () => import( /* webpackChunkName: "sales" */ "./views/app/pages/settings"),
                redirect: "/admin/app/company_Settings/settings",
                children: [{
                        name: "company_settings",
                        path: "settings",
                        component: () =>
                            import( /* webpackChunkName: "company_Settings" */ "./views/app/pages/settings/company_settings")
                    },

                ]
            },




            // Reports
            {
                path: "/admin/app/reports",
                component: () => import("./views/app/pages/reports"),
                redirect: "/admin/app/reports/profit_and_loss",
                children: [{
                        name: "payments_purchases",
                        path: "payments_purchase",
                        component: () =>
                            import( /* webpackChunkName: "payments_purchases" */
                                "./views/app/pages/reports/payments/payments_purchases"
                            )
                    },
                    {
                        name: "payments_sales",
                        path: "payments_sale",
                        component: () =>
                            import( /* webpackChunkName: "payments_sales" */
                                "./views/app/pages/reports/payments/payments_sales"
                            )
                    },
                    {
                        name: "payments_purchases_returns",
                        path: "payments_purchases_returns",
                        component: () =>
                            import( /* webpackChunkName: "payments_purchases_returns" */
                                "./views/app/pages/reports/payments/payments_purchases_returns"
                            )
                    },
                    {
                        name: "payments_sales_returns",
                        path: "payments_sales_returns",
                        component: () =>
                            import( /* webpackChunkName: "payments_sales_returns" */
                                "./views/app/pages/reports/payments/payments_sales_returns"
                            )
                    },

                    {
                        name: "profit_and_loss",
                        path: "profit_and_loss",
                        component: () =>
                            import( /* webpackChunkName: "profit_and_loss" */
                                "./views/app/pages/reports/profit_and_loss"
                            )
                    },

                    {
                        name: "quantity_alerts",
                        path: "quantity_alerts",
                        component: () =>
                            import( /* webpackChunkName: "quantity_alerts" */
                                "./views/app/pages/reports/quantity_alerts"
                            )
                    },
                    {
                        name: "warehouse_report",
                        path: "warehouse_report",
                        component: () =>
                            import( /* webpackChunkName: "warehouse_report" */
                                "./views/app/pages/reports/warehouse_report"
                            )
                    },

                    {
                        name: "sales_report",
                        path: "sales_report",
                        component: () =>
                            import( /* webpackChunkName: "sales_report" */
                                "./views/app/pages/reports/sales_report"
                            )
                    },
                    {
                        name: "purchase_report",
                        path: "purchase_report",
                        component: () =>
                            import( /* webpackChunkName: "purchase_report" */
                                "./views/app/pages/reports/purchase_report"
                            )
                    },

                    {
                        name: "customers_report",
                        path: "customers_report",
                        component: () =>
                            import( /* webpackChunkName: "customers_report" */
                                "./views/app/pages/reports/customers_report"
                            )
                    },
                    {
                        name: "detail_customer_report",
                        path: "detail_customer/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_customer_report" */
                                "./views/app/pages/reports/detail_Customer_Report"
                            )
                    },

                    {
                        name: "providers_report",
                        path: "providers_report",
                        component: () =>
                            import( /* webpackChunkName: "providers_report" */
                                "./views/app/pages/reports/providers_report")
                    },
                    {
                        name: "detail_supplier_report",
                        path: "detail_supplier/:id",
                        component: () =>
                            import( /* webpackChunkName: "detail_supplier_report" */
                                "./views/app/pages/reports/detail_Supplier_Report"
                            )
                    }
                ]
            },

            {
                name: "profile",
                path: "/admin/app/profile",
                component: () => import( /* webpackChunkName: "profile" */ "./views/app/pages/profile")
            }
        ]
    },

    {
        name: "pos",
        path: "/admin/app/pos",
        // beforeEnter: authenticate,
        component: () => import( /* webpackChunkName: "pos" */ "./views/app/pages/pos")
    },

    {
        path: "*",
        name: "NotFound",
        component: () => import( /* webpackChunkName: "NotFound" */ "./views/app/pages/notFound")
    },

    {
        path: "not_authorize",
        name: "not_authorize",
        component: () => import( /* webpackChunkName: "not_authorize" */ "./views/app/pages/NotAuthorize")
    }
];

const router = new Router({
    mode: "history",
    linkActiveClass: "open",
    routes,
    scrollBehavior(to, from, savedPosition) {
        return {
            x: 0,
            y: 0
        };
    }
});

const originalPush = Router.prototype.push
Router.prototype.push = function push(location, onResolve, onReject) {
    if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
    return originalPush.call(this, location).catch(err => err)
}

router.beforeEach((to, from, next) => {

    // If this isn't an initial page load.
    if (to.path) {

        // Start the route progress bar.
        NProgress.start();
        NProgress.set(0.1);
    }
    next();

    if (
        store.state.language.language &&
        store.state.language.language !== i18n.locale
    ) {
        i18n.locale = store.state.language.language;
        next();
    } else if (!store.state.language.language) {
        store.dispatch("language/setLanguage", navigator.languages).then(() => {
            i18n.locale = store.state.language.language;
            next();
        });
    } else {
        next();
    }

});

router.afterEach(() => {
    // Remove initial loading
    const gullPreLoading = document.getElementById("loading_wrap");
    if (gullPreLoading) {
        gullPreLoading.style.display = "none";
    }
    // Complete the animation of the route progress bar.
    setTimeout(() => NProgress.done(), 500);
    // NProgress.done();

    if (window.innerWidth <= 1200) {
        store.dispatch("changeSidebarProperties");
        if (store.getters.getSideBarToggleProperties.isSecondarySideNavOpen) {
            store.dispatch("changeSecondarySidebarProperties");
        }

        if (store.getters.getCompactSideBarToggleProperties.isSideNavOpen) {
            store.dispatch("changeCompactSidebarProperties");
        }
    } else {
        if (store.getters.getSideBarToggleProperties.isSecondarySideNavOpen) {
            store.dispatch("changeSecondarySidebarProperties");
        }

    }
});


async function Check_Token(to, from, next) {
    let token = to.params.token;
    const res = await axios.get('password/find/' + token).then(response => response.data);

    if (!res.success) {
        next("/app/sessions/signIn");
    } else {
        return next();
    }
}


export default router;
