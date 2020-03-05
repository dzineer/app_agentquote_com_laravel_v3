import * as types from './actionTypes';
import authorAPI from '../api/mockAuthorAPI';
import { beginAjaxCall } from "./ajaxStatusActions";

export function createAuthor(author) {
    return { type: types.CREATE_AUTHOR, author }; // or { ... author } no need for author: author in ES6
}

export function loadAuthorsSuccess(authors) {
    // // debugger;
    return { type: types.LOAD_AUTHORS_SUCCESS, authors }; // or { ... author } no need for author: author in ES6
}

export function loadAuthors() {
    return function (dispatch) {
        dispatch(beginAjaxCall());
        return authorAPI.getAllAuthors().then( authors => {
            dispatch(loadAuthorsSuccess(authors))
        }).catch( error => {
            throw(error);
        })
    }
}