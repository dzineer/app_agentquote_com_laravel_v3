import * as types from './actionTypes';
import courseAPI from '../api/mockCourseAPI';
import { beginAjaxCall, ajaxCallError } from "./ajaxStatusActions";

export function createCourseSuccess(course) {
    // // debugger;
    return { type: types.CREATE_COURSE_SUCCESS, course }; // or { ... course } no need for course: course in ES6
}

export function updateCourseSuccess(course) {
    // // debugger;
    return { type: types.UPDATE_COURSE_SUCCESS, course }; // or { ... course } no need for course: course in ES6
}

export function loadCoursesSuccess(courses) {
    // // debugger;
    return { type: types.LOAD_COURSES_SUCCESS, courses }; // or { ... course } no need for course: course in ES6
}

export function loadCourses() {
    return function (dispatch) {
        dispatch(beginAjaxCall());
        return courseAPI.getAllCourses().then( courses => {
           dispatch(loadCoursesSuccess(courses))
        }).catch( error => {
            throw(error);
        })
    }
}

export function saveCourse(course) {
    return function (dispatch, getState) {
        dispatch(beginAjaxCall());
        return courseAPI.saveCourse(course).then( saveCourse => {
            course.id ? dispatch(updateCourseSuccess(saveCourse)) :
                dispatch(createCourseSuccess(saveCourse));
        }).catch(error => {
            dispatch(ajaxCallError(error));
            throw(error);
        })

    }
}