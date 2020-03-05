import * as types from './actionTypes';
import categoryAPI from '../api/mockCategoryAPI';
import { beginAjaxCall } from "./ajaxStatusActions";

export function createCategory(category) {
    return { type: types.CREATE_CATEGORY, category }; // or { ... category } no need for author: author in ES6
}

export function loadCategoriesSuccess(categories) {
    // // debugger;
    console.log('loadCategoriesSuccess: ', categories);
    return { type: types.LOAD_CATEGORIES_SUCCESS, categories }; // or { ... author } no need for author: author in ES6
}

export function loadCategories() {
    return function (dispatch) {
        console.log('loadCategories: ');
        dispatch(beginAjaxCall());
        return categoryAPI.getAllCategories().then( categories => {
            console.log('loadCategories: ', categories);
            dispatch(loadCategoriesSuccess(categories))
        }).catch( error => {
            throw(error);
        })
    }
}