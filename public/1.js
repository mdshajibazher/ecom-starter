(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Collections.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Collections.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vform__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vform */ "./node_modules/vform/dist/vform.common.js");
/* harmony import */ var vform__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vform__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _error_ValidationErrors__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./error/ValidationErrors */ "./resources/js/components/error/ValidationErrors.vue");
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-multiselect */ "./node_modules/vue-multiselect/dist/vue-multiselect.min.js");
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_multiselect__WEBPACK_IMPORTED_MODULE_2__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ValidationErrors: _error_ValidationErrors__WEBPACK_IMPORTED_MODULE_1__["default"],
    Multiselect: vue_multiselect__WEBPACK_IMPORTED_MODULE_2___default.a
  },
  props: {
    editMode: {
      type: Boolean,
      "default": false
    },
    groupLabels: {
      type: Array,
      required: true
    },
    image: {
      type: Object
    }
  },
  data: function data() {
    return {
      title: '',
      validationErrors: '',
      sub_collection: [],
      sub_collection_options: [],
      showModal: false,
      sub_collection_form: new vform__WEBPACK_IMPORTED_MODULE_0___default.a({
        title: ''
      })
    };
  },
  methods: {
    errorFree: function errorFree() {
      this.validationErrors = '';
    },
    addSubCollection: function addSubCollection() {
      var _this = this;

      this.$Progress.start();
      this.sub_collection_form.busy = true;
      this.sub_collection_form.post('/app/subcollections').then(function (_ref) {
        var data = _ref.data;
        console.log(data);

        _this.$Progress.finish();

        _this.showModal = false;

        _this.successMsg("Subcollection Stored Successfully");
      });
    },
    // store product into database
    saveCollection: function saveCollection() {
      this.$Progress.start();
      this.validationErrors = '';

      if (this.editMode) {// axios.put('/app/product/'+this.products.id, product).then(response => {
        //    this.successMsg("Record updated successfully");
        //    this.$Progress.finish();
        //    window.location = '/app/product';
        // }).catch((error )=> {
        //     let errors=error.response.data.errors;
        //     if (error.response.status == 422){
        //     this.validationErrors = error.response.data.errors;
        //     }
        //     this.errorMsg(errors);
        //     this.$Progress.fail();
        // })
      } else {// axios.post('/app/product', product).then(response => {
          //         this.successMsg("Record created successfully");
          //         this.$Progress.finish();
          //         window.location = '/app/product';
          // }).catch((error) => {
          //     let errors=error.response.data.errors;
          //     if (error.response.status == 422){
          //     this.validationErrors = error.response.data.errors;
          //     }
          //     this.errorMsg(errors);
          //     this.$Progress.fail();
          // })
        }
    },
    successMsg: function successMsg(msg) {
      iziToast.success({
        title: 'Success',
        position: 'topRight',
        message: msg
      });
    },
    errorMsg: function errorMsg(msg) {
      $.each(msg, function (index, value) {
        iziToast.error({
          title: 'Error',
          position: 'topRight',
          message: value
        });
      });
    }
  },
  created: function created() {
    console.log(groupLabels);
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa& ***!
  \**************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.showModal
        ? _c(
            "vue-modal",
            {
              on: {
                close: function($event) {
                  _vm.showModal = false
                }
              }
            },
            [
              _c("div", { attrs: { slot: "body" }, slot: "body" }, [
                _c(
                  "form",
                  {
                    on: {
                      keydown: function($event) {
                        return _vm.sub_collection_form.onKeydown($event)
                      }
                    }
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "title" } }, [
                          _vm._v("Subcollection Title")
                        ]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.sub_collection_form.title,
                              expression: "sub_collection_form.title"
                            }
                          ],
                          staticClass: "form-control",
                          class: {
                            "is-invalid": _vm.sub_collection_form.errors.has(
                              "title"
                            )
                          },
                          attrs: {
                            type: "text",
                            placeholder: "Enter Subcollection Title"
                          },
                          domProps: { value: _vm.sub_collection_form.title },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.sub_collection_form,
                                "title",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _c("has-error", {
                          attrs: {
                            form: _vm.sub_collection_form,
                            field: "title"
                          }
                        })
                      ],
                      1
                    )
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { attrs: { slot: "footer" }, slot: "footer" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-danger",
                    on: {
                      click: function($event) {
                        _vm.showModal = false
                      }
                    }
                  },
                  [_vm._v("\n                    x \n            ")]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary",
                    attrs: {
                      disabled: _vm.sub_collection_form.busy,
                      type: "button"
                    },
                    on: {
                      click: function($event) {
                        return _vm.addSubCollection()
                      }
                    }
                  },
                  [_vm._v("Submit")]
                )
              ])
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "row",
          on: {
            keydown: function($event) {
              return _vm.errorFree()
            }
          }
        },
        [
          _c("div", { staticClass: "col-md-12" }, [
            _c("div", { staticClass: "card shadow mb-4" }, [
              _c("div", { staticClass: "card-body" }, [
                _c(
                  "div",
                  { staticClass: "form-group" },
                  [
                    _vm.validationErrors
                      ? _c("validation-errors", {
                          attrs: { errors: _vm.validationErrors }
                        })
                      : _vm._e()
                  ],
                  1
                ),
                _vm._v(" "),
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { attrs: { for: "title" } }, [
                    _vm._v("Collection Title")
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.title,
                        expression: "title"
                      }
                    ],
                    staticClass: "form-control",
                    class: { "is-invalid": _vm.validationErrors.title },
                    attrs: { type: "text", placeholder: "Category Title" },
                    domProps: { value: _vm.title },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.title = $event.target.value
                      }
                    }
                  }),
                  _vm._v(" "),
                  _vm.validationErrors.title
                    ? _c("p", { staticClass: "text-danger" }, [
                        _vm._v(_vm._s(_vm.validationErrors.title[0]))
                      ])
                    : _vm._e()
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-9" }, [
                    _c(
                      "div",
                      { staticClass: "form-group" },
                      [
                        _c("label", { attrs: { for: "sub_collection" } }, [
                          _vm._v("Select Some Subcollection")
                        ]),
                        _vm._v(" "),
                        _c("multiselect", {
                          attrs: { options: _vm.sub_collection_options },
                          model: {
                            value: _vm.sub_collection,
                            callback: function($$v) {
                              _vm.sub_collection = $$v
                            },
                            expression: "sub_collection"
                          }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-3 mt-3" }, [
                    _c("div", { staticClass: "form-group mt-3" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-success",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              _vm.showModal = true
                            }
                          }
                        },
                        [
                          _c("i", { staticClass: "fas fa-plus" }),
                          _vm._v(" Add Subcollection")
                        ]
                      )
                    ])
                  ])
                ])
              ])
            ])
          ])
        ]
      ),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "btn btn-lg btn-primary",
          attrs: { type: "submit" },
          on: { click: _vm.saveCollection }
        },
        [
          _vm.editMode
            ? _c("span", [_vm._v("Update")])
            : _c("span", [_vm._v("Save")])
        ]
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Collections.vue":
/*!*************************************************!*\
  !*** ./resources/js/components/Collections.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Collections.vue?vue&type=template&id=2adc4dfa& */ "./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa&");
/* harmony import */ var _Collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Collections.vue?vue&type=script&lang=js& */ "./resources/js/components/Collections.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Collections.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Collections.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/Collections.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Collections.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Collections.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Collections_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Collections.vue?vue&type=template&id=2adc4dfa& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Collections.vue?vue&type=template&id=2adc4dfa&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Collections_vue_vue_type_template_id_2adc4dfa___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);