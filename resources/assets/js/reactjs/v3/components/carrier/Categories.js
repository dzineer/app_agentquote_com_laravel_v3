import React from 'react';
import PropTypes from 'prop-types';
import CheckBoxInput from "../CheckBoxInput/CheckBoxInput";
import Carriers from "./Carriers";

/** function: Categories */
const Categories = ({categories, onChange, indeterminate}) => {

    const styles = {
        categories: {
           /* background: '#FF9800',*/
            padding: '7px 28px',
            color: 'black',
            borderBottom: '3px solid #0c75b6',
            paddingBottom: '6px',
            margin: '18px 0'
        }
    };
    
    const onCategoryChange = (type, name, value, parent, el) => {
        return onChange(type, name, value, parent, el);
    };

    return (
        <div>
            { categories.map( category => {
                return (

                    <div key={category.name}>
                        <CheckBoxInput
                            name={ category.name }
                            label={ category.label }
                            indeterminate={indeterminate}
                            style={styles.categories}
                            onChange={ onCategoryChange.bind(this, "category", category.name, category.name, "root") }
                        />

                        <Carriers carriers={ category.carriers } onChange={onChange} parent={category.name} />
                    </div>
                )

            })}
        </div>
    );
};

Categories.propTypes = {
    categories: PropTypes.array.isRequired,
    onChange: PropTypes.func.isRequired,
    indeterminate: PropTypes.bool
};

Categories.defaultProps = {
    indeterminate: false,
    categories: {}
};

export default Categories;