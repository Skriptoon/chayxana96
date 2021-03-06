/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin.event.js":
/*!*************************************!*\
  !*** ./resources/js/admin.event.js ***!
  \*************************************/
/***/ (() => {

$('.offcanvas-category').click(function () {
  var myOffcanvas = document.getElementById('categoryedit');
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

  if (!$(this).attr('id')) {
    $('input[name="name"]').val('');
    $('input[name="id"]').val(category.length);
    $('option').prop('selected', false);
    $('.btn-delete').addClass('invisible');
  } else {
    $('input[name="name"]').val(category[$(this).attr('id')]['name']);
    $('input[name="id"]').val($(this).attr('id'));
    $('option[value="' + category[$(this).attr('id')]['menu'] + '"]').prop('selected', true);
    $('.btn-delete').removeClass('invisible');
  }

  bsOffcanvas.show();
});
$('.btn-save').click(function () {
  var data = $(this).parent().serialize();
  var elem = $(this);
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/categoryadmin/save',
    type: 'POST',
    cache: false,
    data: data,
    success: function success() {
      location.reload();
    },
    error: function error(data) {
      elem.prop("disabled", false);

      for (var key in data.responseJSON.errors) {
        $('input[name="' + key + '"]').addClass('is-invalid');
        $('input[name="' + key + '"]').parent().children('.invalid-tooltip').text(data.responseJSON.errors[key]);
      }
    }
  });
  return false;
});
$('input[type="text"]').focus(function () {
  $(this).removeClass('is-invalid');
});
$('.btn-delete').click(function () {
  var data = $(this).parent().serialize();
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/categoryadmin/delete',
    type: 'POST',
    cache: false,
    data: data,
    success: function success() {
      location.reload();
    }
  });
  return false;
}); /////////////////////////////////////////////////

$('.offcanvas-position').click(function () {
  var myOffcanvas = document.getElementById('positionedit');
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

  if (!$(this).attr('id')) {
    $('input[name="name"]').val('');
    $('input[name="price"]').val('');
    $('label[for="formFile"]').html('?????????????????????? ??????????????');
    $('textarea[name="desc"]').val('');
    $('input[name="id"]').val(positions.length);
    $('option').prop('selected', false);
    $('.btn-delete-pos').addClass('invisible');
    $('input[name="main_page"]').prop('checked', false);
  } else {
    $('input[name="name"]').val(positions[$(this).attr('id')]['name']);
    $('input[name="price"]').val(positions[$(this).attr('id')]['price']);
    $('label[for="formFile"]').html('<img src="' + positions[$(this).attr('id')]['img'] + '" width="100">');
    $('textarea[name="desc"]').val(positions[$(this).attr('id')]['desc']);
    $('input[name="id"]').val($(this).attr('id'));
    $('option[value="' + positions[$(this).attr('id')]['id_category'] + '"]').prop('selected', true);
    $('.btn-delete-pos').removeClass('invisible');
    if (positions[$(this).attr('id')]['main_page']) $('input[name="main_page"]').prop('checked', true);else $('input[name="main_page"]').prop('checked', false);
  }

  bsOffcanvas.show();
});
$('.btn-delete-pos').click(function () {
  var data = $(this).parent().serialize();
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/positionadmin/delete',
    type: 'POST',
    cache: false,
    data: data,
    success: function success() {
      location.reload();
    }
  });
  return false;
});
$('.btn-save-pos').click(function () {
  var file_data = $(this).parent().children("div").children("input[type='file']").prop("files")[0];
  var query = new FormData(document.getElementById($(this).parent().attr("id")));
  query.append('menu_img', file_data);
  var elem = $(this);
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/positionadmin/save',
    type: 'POST',
    cache: false,
    data: query,
    processData: false,
    contentType: false,
    success: function success() {
      location.reload();
    },
    error: function error(data) {
      elem.prop("disabled", false);

      for (var key in data.responseJSON.errors) {
        $('input[name="' + key + '"]').addClass('is-invalid');
        $('input[name="' + key + '"]').parent().children('.invalid-tooltip').text(data.responseJSON.errors[key]);
      }
    }
  });
  return false;
});
$(".btn-save-page").click(function () {
  var query = 'text=' + escapeRegExp(nicEditors.findEditor('area2').getContent()) + '&id=' + $(this).attr('id');
  $.ajax({
    url: "/ajax/page/save",
    type: "POST",
    data: query,
    cache: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {}
  });
});

function escapeRegExp(string) {
  return string.replace(/[&]/g, "/amp/");
}

$('.offcanvas-banner').click(function () {
  var myOffcanvas = document.getElementById('banneredit');
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

  if (!$(this).attr('id')) {
    $('input[name="header"]').val('');
    $('input[name="text"]').val('');
    $('input[name="id"]').val(banner.length);
    $('label[for="formFile"]').html('?????????????????????? ????????????');
    $('.btn-delete-banner').addClass('invisible');
  } else {
    $('input[name="header"]').val(banner[$(this).attr('id')]['header']);
    $('input[name="text"]').val(banner[$(this).attr('id')]['text']);
    $('input[name="id"]').val($(this).attr('id'));
    $('label[for="formFile"]').html('<img src="' + banner[$(this).attr('id')]['img'] + '" width="100">');
    $('.btn-delete-banner').removeClass('invisible');
  }

  bsOffcanvas.show();
});
$('.btn-save-banner').click(function () {
  var file_data = $(this).parent().children("div").children("input[type='file']").prop("files")[0];
  var query = new FormData(document.getElementById($(this).parent().attr("id")));
  query.append('banner_img', file_data);
  var elem = $(this);
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/banner/save',
    type: 'POST',
    cache: false,
    data: query,
    processData: false,
    contentType: false,
    success: function success() {
      location.reload();
    },
    error: function error(data) {
      elem.prop("disabled", false);

      for (var key in data.responseJSON.errors) {
        $('input[name="' + key + '"]').addClass('is-invalid');
        $('input[name="' + key + '"]').parent().children('.invalid-tooltip').text(data.responseJSON.errors[key]);
      }
    }
  });
  return false;
});
$('.btn-delete-banner').click(function () {
  var data = $(this).parent().serialize();
  $(this).prop("disabled", true);
  $.ajax({
    url: '/ajax/banner/delete',
    type: 'POST',
    cache: false,
    data: data,
    success: function success() {
      location.reload();
    }
  });
  return false;
});

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./admin.event */ "./resources/js/admin.event.js");

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/scss/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;