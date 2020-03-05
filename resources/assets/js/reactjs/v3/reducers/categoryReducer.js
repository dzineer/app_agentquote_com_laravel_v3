import * as types from '../actions/actionTypes';
import initialState from "./initialState";

export default function categoryReducer(state = initialState.categories, action) {
    switch( action.type ) {
        case types.LOAD_CATEGORIES_SUCCESS:
            console.log('categoryReducer: ', action);
            return action.categories;

        case 'getCategories':
            return action.payload.categories;

        case types.CREATE_CATEGORY_SUCCESS:
            return [
                ...state,
                Object.assign({}, action.category)
            ];

        case types.UPDATE_CATEGORIES_SUCCESS:
            return [
                ...state.filter(category => category.id !== action.category.id),
                Object.assign({}, action.category)
            ];

        default:
            return state;
    }
}