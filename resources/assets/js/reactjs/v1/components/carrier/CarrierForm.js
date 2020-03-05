import React, { Component } from 'react';
import PropTypes from 'prop-types';
import Categories from "./Categories";
import carrierAPI from '../../api/mockCategoryAPI';
import ReactDom from "react-dom";
import AccountInfo from "../user/AccountInfo";
import configureStore from "../../store/configureStore";
import {loadCategories} from "../../actions/categoryActions";
import * as categoryActions from "../../actions/categoryActions";
import { bindActionCreators } from 'redux';
import ContentForm from "../common/ContentForm";
import { connect } from "react-redux";

/** function: CarrierForm */
class CarrierForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            categories: []
        };

        this.css = {
            for: {
                carriers: {
                    marginLeft: '20px'
                },
                products: {
                    marginLeft: '20px'
                }
            }
        };

        this.parents = "";
        this.category = "";
        this.product = "";
    };

    componentDidMount() {
        let newState = Object.assign({}, this.state, { categories: this.props.categories });
        this.setState(newState);
    }

    setCategoryState(category) {

        let newState = Object.assign({}, this.state);
        let catIndex = newState.categories.findIndex(cat => cat.name === category);
        const chosenCategory = newState.categories[catIndex];

        if (!chosenCategory.indeterminate && !chosenCategory.checked) {

            // state: clicked - not checked - not indeterminate - new
            document.getElementById(chosenCategory.name).checked = false;
            newState.categories[catIndex].checked = false;

            // set to indeterminate
            document.getElementById(chosenCategory.name).indeterminate = true;
            newState.categories[catIndex].indeterminate = true;

        } else if (chosenCategory.indeterminate && !chosenCategory.checked) {

            // state: clicked - indeterminate - not checked

            // set category to not indeterminate
            document.getElementById(chosenCategory.name).indeterminate = false;
            newState.categories[catIndex].indeterminate = false;

            // set category to checked
            document.getElementById(chosenCategory.name).checked = true;
            newState.categories[catIndex].checked = true;

            // check all carriers and products

            for (let i=0; i < chosenCategory.carriers.length; i++) {
                document.getElementById(chosenCategory.carriers[i].name).checked = true;
                newState.categories[catIndex].carriers[i].checked = true;

                document.getElementById(chosenCategory.carriers[i].name).indeterminate = false;
                newState.categories[catIndex].carriers[i].indeterminate = false;

                for (let j=0; j < chosenCategory.carriers[i].products.length; j++) {
                    document.getElementById(chosenCategory.carriers[i].products[j].name).checked = true;
                    newState.categories[catIndex].carriers[i].products[j].checked = true;
                }
            }

        } else if (!chosenCategory.indeterminate && chosenCategory.checked) {

            // set category to not indeterminate
            document.getElementById(chosenCategory.name).indeterminate = false;
            newState.categories[catIndex].indeterminate = false;

            // set category to checked
            document.getElementById(chosenCategory.name).checked = false;
            newState.categories[catIndex].checked = false;

            // check all carriers and products

            for (let i=0; i < chosenCategory.carriers.length; i++) {

                document.getElementById(chosenCategory.carriers[i].name).checked = false;
                newState.categories[catIndex].carriers[i].checked = false;
                document.getElementById(chosenCategory.carriers[i].name).indeterminate = false;
                newState.categories[catIndex].carriers[i].indeterminate = false;

                for (let j=0; j < chosenCategory.carriers[i].products.length; j++) {
                    document.getElementById(newState.categories[catIndex].carriers[i].products[j].name).checked = false;
                    newState.categories[catIndex].carriers[i].products[j].checked = false;
                }
            }

        }

        this.setState(newState);
    }

    updateIndeterminateCarrierState(newState, catIndex, carrierIndex, indeterminate) {
        // state: clicked - not checked - not indeterminate - new

        const chosenCategory = newState.categories[catIndex];
        const chosenCarrier = chosenCategory.carriers[carrierIndex];

        document.getElementById(chosenCarrier.name).indeterminate = indeterminate;
        // set to indeterminate
        newState.categories[catIndex].carriers[carrierIndex].indeterminate = indeterminate;

        document.getElementById(chosenCategory.name).indeterminate = indeterminate;
        newState.categories[catIndex].indeterminate = indeterminate;

        return newState;
    }

    clickedIndeterminateNotChecked(newState, catIndex, carrierIndex) {
        // set carrier to not indeterminate
        const chosenCategory = newState.categories[catIndex];
        const chosenCarrier = chosenCategory.carriers[carrierIndex];

        document.getElementById(chosenCarrier.name).indeterminate = false;
        newState.categories[catIndex].carriers[carrierIndex].indeterminate = false;

        // set carrier to checked
        document.getElementById(chosenCarrier.name).checked = true;
        newState.categories[catIndex].carriers[carrierIndex].checked = true;

        // check all children

        for (let i=0; i < chosenCarrier.products.length; i++) {
            document.getElementById(chosenCarrier.products[ i ].name).checked = true;
            newState.categories[catIndex].carriers[carrierIndex].products[ i ].checked = true;
        }

        // check if category is checked
        if (! chosenCategory.checked) {

            let carriersChecked = chosenCategory.carriers.filter(c => {
                return c.checked === true
            });

            let productsChecked = chosenCarrier.products.filter(p => {
                return p.checked === true
            });

            if ((carriersChecked.length === chosenCategory.carriers.length) &&
                productsChecked.length === chosenCarrier.products.length) {
                document.getElementById(chosenCategory.name).checked = true;
                newState.categories[catIndex].checked = true;
                document.getElementById(chosenCategory.name).indeterminate = false;
                newState.categories[catIndex].indeterminate = false;
            } else {
                document.getElementById(chosenCategory.name).indeterminate = true;
                newState.categories[catIndex].indeterminate = true;
            }
        }

        return newState;
    }

    clickedNotIndeterminateChecked(newState, catIndex, carrierIndex) {
        // un-check carrier
        const chosenCategory = newState.categories[catIndex];
        const chosenCarrier = chosenCategory.carriers[carrierIndex];

        document.getElementById(chosenCarrier.name).checked = false;
        newState.categories[catIndex].carriers[carrierIndex].checked = false;

        document.getElementById(chosenCarrier.name).indeterminate = false;
        newState.categories[catIndex].carriers[carrierIndex].indeterminate = false;

        let numCarriersChecked = chosenCategory.carriers.filter(car => {
            return car.checked === true || car.indeterminate === true
        });

        for (let i=0; i < chosenCarrier.products.length; i++) {
            document.getElementById(chosenCarrier.products[ i ].name).checked = false;
            newState.categories[catIndex].carriers[carrierIndex].products[ i ].checked = false;
        }

        if (!numCarriersChecked || numCarriersChecked.length === 0) {
            document.getElementById(chosenCategory.name).checked = false;
            newState.categories[catIndex].checked = false;

            document.getElementById(chosenCategory.name).indeterminate = false;
            newState.categories[catIndex].indeterminate = false;
        } else {
            document.getElementById(chosenCategory.name).checked = false;
            newState.categories[catIndex].checked = false;

            document.getElementById(chosenCategory.name).indeterminate = true;
            newState.categories[catIndex].indeterminate = true;
        }

        return newState;
    }

    setCarrierState(category, carrier) {
        let newState = Object.assign({}, this.state);
        let catIndex = newState.categories.findIndex(cat => cat.name === category);
        let carrierIndex = newState.categories[catIndex].carriers.findIndex(car => car.name === carrier);

        const chosenCategory = newState.categories[catIndex];
        const chosenCarrier = chosenCategory.carriers[carrierIndex];

    //    // debugger;


        if (!chosenCarrier.indeterminate && !chosenCarrier.checked) {
            // this.updateCarrierState(newState, catIndex, carrierIndex, indeterminate, checked)
            newState = this.updateIndeterminateCarrierState(newState, catIndex, carrierIndex, true);

        } else if (chosenCarrier.indeterminate && !chosenCarrier.checked) {
            // state: clicked - indeterminate - not checked
            // clickedIndeterminateNotChecked(newState, catIndex, carrierIndex)
            newState = this.clickedIndeterminateNotChecked(newState, catIndex, carrierIndex);

        } else if (!chosenCarrier.indeterminate && chosenCarrier.checked) {
            // clicked - not indeterminate - checked
            // un-check carrier
            newState = this.clickedNotIndeterminateChecked(newState, catIndex, carrierIndex);
        }
        this.setState(newState);
    }

    isChecked(id) {
        return document.getElementById(id).checked;
    }

    setCarrierProductState(category, carrier, product, inputState) {
        let newState = Object.assign({}, this.state);
        let catIndex = newState.categories.findIndex(cat => cat.name === category);
        // debugger;
        const chosenCategory = newState.categories[catIndex];
        let carrierIndex = chosenCategory.carriers.findIndex(car => car.name === carrier);
        const chosenCarrier = chosenCategory.carriers[carrierIndex];
        let productIndex = chosenCarrier.products.findIndex(prod => prod.name === product);

        newState.categories[catIndex].carriers[carrierIndex].products[productIndex].checked = inputState;
        const chosenProducts = chosenCarrier.products[productIndex];

        let numProdChecked = chosenCarrier.products.filter(prod => {
            return prod.checked === true
        });

        let numCarriersChecked = chosenCategory.carriers.filter(car => {
            return car.checked === true
        });

        if (inputState) {
            if (this.isChecked(chosenProducts.name)) {
                if (numProdChecked.length === chosenCarrier.products.length) {
                    document.getElementById(chosenCarrier.name).checked = true;
                    newState.categories[catIndex].carriers[carrierIndex].checked = true;
                    document.getElementById(chosenCarrier.name).indeterminate = false;
                    newState.categories[catIndex].carriers[carrierIndex].indeterminate = false;

                    numCarriersChecked = chosenCategory.carriers.filter(car => {
                        return car.checked === true
                    });

                    if (numCarriersChecked.length === chosenCategory.carriers.length) {
                        document.getElementById(chosenCategory.name).checked = true;
                        newState.categories[catIndex].checked = true;
                        document.getElementById(chosenCategory.name).indeterminate = false;
                        newState.categories[catIndex].indeterminate = false;
                    }

                } else {
                    document.getElementById(chosenCarrier.name).checked = true;
                    newState.categories[catIndex].carriers[carrierIndex].checked = false;
                    document.getElementById(chosenCarrier.name).indeterminate = true;
                    newState.categories[catIndex].carriers[carrierIndex].indeterminate = false;
                    document.getElementById(chosenCategory.name).checked = true;
                    newState.categories[catIndex].checked = true;
                    document.getElementById(chosenCategory.name).indeterminate = true;
                    newState.categories[catIndex].indeterminate = true;
                }
            }
        } else {
            if (numProdChecked.length === 0) {
                document.getElementById(chosenCarrier.name).indeterminate = false;
                document.getElementById(chosenCarrier.name).checked = false;
                newState.categories[catIndex].carriers[carrierIndex].indeterminate = false;
                newState.categories[catIndex].carriers[carrierIndex].checked = false;

                if (numCarriersChecked.length === 0) {
                    document.getElementById(chosenCategory.name).checked = false;
                    newState.categories[catIndex].checked = false;
                    document.getElementById(chosenCategory.name).indeterminate = false;
                    newState.categories[catIndex].indeterminate = false;
                }

            } else {
                document.getElementById(chosenCarrier.name).checked = false;
                newState.categories[catIndex].carriers[carrierIndex].checked = false;
                document.getElementById(chosenCarrier.name).indeterminate = true;
                newState.categories[catIndex].carriers[carrierIndex].indeterminate = true;
                document.getElementById(chosenCategory.name).checked = false;
                newState.categories[catIndex].checked = false;
                document.getElementById(chosenCategory.name).indeterminate = true;
                newState.categories[catIndex].indeterminate = true;
            }
        }

        this.setState(newState);
    }


    // console.log('CourseForm', [course, allAuthors, onSave, onChange, saving, errors])

    onChange = (type, name, value, parents, el) => {

      const inputState = el.target.checked;
      this.parents = parents.split(",");
      console.log('state', this.state);

      if ( type === "category") {
          this.setCategoryState(value);
      //    toastr.success(name + " (Category) " + ": " + value);
      } else if (type === "carrier") {
          this.setCarrierState(this.parents[0], value);
      //    toastr.success(name + " (Carrier) " + ": " + value);
      } else if (type === "product"){
          this.setCarrierProductState(this.parents[0], this.parents[1], value, inputState);
      //    toastr.success(name + " (Product) " + ": " + value);
      }
    };

    render() {

        const errors = null;

        console.log("props", this.props);

        // return (<div>Hey</div>);

        return (
            <ContentForm name="carrier-form">

                <div>
                    <Categories categories={this.props.categories} styles={this.css} onChange={this.onChange.bind(this)} />
                </div>

                <br /><br />
            </ContentForm>
        );
    }

};

CarrierForm.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
    categories: PropTypes.array
};

CarrierForm.defaultProps = {
    categories:[]
};

const mapStateToProps = (state, ownProps) => {
    return { categories: state.categories };
};

const mapDispatchToProps = (dispatch) => {
    return {
        actions: bindActionCreators(categoryActions, dispatch)
    }
};

export default connect(mapStateToProps)(CarrierForm);
// export default connect(mapStateToProps, mapDispatchToProps)(CarrierForm);