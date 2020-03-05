import delay from './delay';
import { generateId } from '../generators';
import * as types from "../actions/actionTypes";
import {beginAjaxCall} from "../actions/ajaxStatusActions";
import categoryAPI from "./mockCategoryAPI";
import {loadCategoriesSuccess} from "../actions/categoryActions";

// This file mocks a web API by working with the hard-coded data below.
// It uses setTimeout to simulate the delay of an AJAX call.
// All calls return promises.

const categories = [
    {
        id: "termlife",
        name: "termlife",
        label: "Term Life",
        indeterminate: false,
        checked: false,
        carriers: [
            {   id: "american_general",
                name: "american_general",
                label: "American General",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_10", name: "term_10", label: "Term 10", checked: false },
                    { id: "term_15", name: "term_15", label: "Term 15", checked: false },
                    { id: "term_20", name: "term_20", label: "Term 20", checked: false },
                    { id: "term_25", name: "term_25", label: "Term 25", checked: false },
                ]
            },
            {   id: "metlife",
                name: "metlife",
                label: "Metlife",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_ml_10", name: "term_ml_10", label: "Term ML 10", checked: false },
                    { id: "term_ml_15", name: "term_ml_15", label: "Term ML 15", checked: false },
                    { id: "term_ml_20", name: "term_ml_20", label: "Term ML 20", checked: false },
                    { id: "term_ml_25", name: "term_ml_25", label: "Term ML 25", checked: false },
                ]
            }
        ]
    },
    {
        id: "sit",
        name: "sit",
        label: "Simplified Issue",
        indeterminate: false,
        checked: false,
        carriers: [
            {   id: "american_general-2",
                name: "american_general-2",
                label: "American General",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_1_10", name: "term_1_10", label: "Term 1 10", checked: false },
                    { id: "term_1_15", name: "term_1_15", label: "Term 1 15", checked: false },
                    { id: "term_1_20", name: "term_1_20", label: "Term 1 20", checked: false },
                    { id: "term_1_25", name: "term_1_25", label: "Term 1 25", checked: false },
                ]
            },
            {   id: "metlife-2",
                name: "metlife-2",
                label: "Metlife",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_ml_1_10", name: "term_ml_1_10", label: "Term ML 1 10", checked: false },
                    { id: "term_ml_1_15", name: "term_ml_1_15", label: "Term ML 1 15", checked: false },
                    { id: "term_ml_1_20", name: "term_ml_1_20", label: "Term ML 1 20", checked: false },
                    { id: "term_ml_1_25", name: "term_ml_1_25", label: "Term ML 1 25", checked: false },
                ]
            }
        ]
    },
    {
        id: "siwl",
        name: "siwl",
        label: "Final Expense (SIWL)",
        indeterminate: false,
        checked: false,
        carriers: [
            {   id: "american_general-3",
                name: "american_general-3",
                label: "American General",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_2_10", name: "term_2_10", label: "Term 2 10", checked: false },
                    { id: "term_2_15", name: "term_2_15", label: "Term 2 15", checked: false },
                    { id: "term_2_20", name: "term_2_20", label: "Term 2 20", checked: false },
                    { id: "term_2_25", name: "term_2_25", label: "Term 2 25", checked: false },
                ]
            },
            {   id: "metlife-3",
                name: "metlife-3",
                label: "Metlife",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_ml_2_10", name: "term_ml_2_10", label: "Term ML 2 10", checked: false },
                    { id: "term_ml_2_15", name: "term_ml_2_15", label: "Term ML 2 15", checked: false },
                    { id: "term_ml_2_20", name: "term_ml_2_20", label: "Term ML 2 20", checked: false },
                    { id: "term_ml_2_25", name: "term_ml_2_25", label: "Term ML 2 25", checked: false },
                ]
            }
        ]
    },
    {
        id: "gul",
        name: "gul",
        label: "GUL",
        indeterminate: false,
        checked: false,
        carriers: [
            {   id: "american_general-4",
                name: "american_general-4",
                label: "American General",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_4_10", name: "term_4_10", label: "Term 4 10", checked: false },
                    { id: "term_4_15", name: "term_4_15", label: "Term 4 15", checked: false },
                    { id: "term_4_20", name: "term_4_20", label: "Term 4 20", checked: false },
                    { id: "term_4_25", name: "term_4_25", label: "Term 4 25", checked: false },
                ]
            },
            {   id: "metlife-4",
                name: "metlife-4",
                label: "Metlife",
                indeterminate: false,
                checked: false,
                products: [
                    { id: "term_ml_4_10", name: "term_ml_4_10", label: "Term ML 4 10", checked: false },
                    { id: "term_ml_4_15", name: "term_ml_4_15", label: "Term ML 4 15", checked: false },
                    { id: "term_ml_4_20", name: "term_ml_4_20", label: "Term ML 4 20", checked: false },
                    { id: "term_ml_4_25", name: "term_ml_4_25", label: "Term ML 4 25", checked: false },
                ]
            }
        ]
    },
];

let savedCategories = [];

class CategoryAPI {
    static getAllCategories() {
        console.log('Categories:', categories);
        return (Object.assign([], categories));
    }
}

export default CategoryAPI;