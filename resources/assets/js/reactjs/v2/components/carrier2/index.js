import React, { Component } from 'react';
import ReactDom, { render } from "react-dom";
import {Provider} from 'react-redux';
import { bindActionCreators } from 'redux';
import {createBrowserHistory as history} from "history";
import { combineReducers, createStore } from 'redux';
import productsReducer from "../../reducers/productsReducer";
import userReducer from "../../reducers/userReducer";
import categoryReducer from "../../reducers/categoryReducer";
import CategoryAPI from "../../api/mockCategoryAPI";
import CarrierForm from "../carrier/CarrierForm";

import { connect } from "react-redux";

const allReducers = combineReducers({
    categories: categoryReducer,
    products: productsReducer,
    user: userReducer
});

const updateUserAction = {
    type: 'updateUser',
    payload: { user: 'John' }
};

const getCategoriesAction = {
    type: 'getCategories',
    payload: {
        categories: CategoryAPI.getAllCategories()
    }
};

const store = createStore(
    allReducers, {
        products: [{name: "iPhone"}],
        user: 'Frank'
    },
    window.devToolsExtension && window.devToolsExtension()
);

// store.dispatch(updateUserAction);
store.dispatch(getCategoriesAction);

console.log('Store', store.getState());

if (document.getElementById('carriers')) {
    render(
        <Provider store={store}>
            <CarrierForm />
        </Provider>,
        document.getElementById('carriers')
    )
}