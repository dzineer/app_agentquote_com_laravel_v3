import React, {Component} from 'react';
import ReactDOM from "react-dom";
import PropTypes from 'prop-types';
import { AddItemIcon, ColumnsIcon, CopyIcon, XIcon } from "./Icons/Icons";
import PageSection from "./PageSection/PageSection";
import SectionRow from "./SectionRow/SectionRow";

/** class BlockComponent */
class BlockComponent extends Component {
    constructor(props) {
        super(props);
        this.state = {
            columnContainer: null,
            defaultBuild: [12],
            columns: [1,2,3,4],
            builds: {
                byColumnsIcon: {
                    "1" : [12],
                    "2" : [6,6],
                    "3" : [4,4,4],
                    "4" : [3,3,3,3]
                },
                byColumnNumbers: {
                    "1,11" : [1,11],
                    "2,10" : [2,10],
                    "3,9"  : [3,9],
                    "4,8"  : [4,8],
                    "5,7"  : [5,7],
                    "6,6"  : [6,6],
                    "7,5"  : [7,5],
                    "8,4"  : [8,4],
                    "9,3"  : [9,3],
                    "10,2" : [10,2],
                    "11,1" : [11,1],
                }
            },
            row: []
        };
        this.buildSelect.bind(this);
        this.onSelectChange.bind(this);
        this.buildRow.bind(this);
        this.buildSectionDisplay.bind(this);
        this.buildRowDisplay.bind(this);
    }

    componentDidMount() {
        this.buildRow( this.state.defaultBuild );
    }

    buildRow = (columnsToBuild) => {

        let build = null;

        debugger;

        build = columnsToBuild.map( column => {
            return <div className={ "col-md-" + column + " visual-line" } />
        });

        let row = <div className="row">{ build }</div>;

        this.setState({
            row
        });
    };

    onSelectChange = (e) => {
        let columnsToBuild = e.currentTarget.value.split(',');
        this.buildRow( columnsToBuild );
    };

    buildColumnsIconSelect = () => {
        let inside = this.state.columns.map( column => {
            return <option value={ column }> { column + " column(s)"}</option>

        });
        return <select onChange={ this.onSelectChange } > {inside} </select>;
    };

    buildSelect = () => {
        debugger;
        let inside = this.state.builds.columns.map(build => {
            debugger;
            // let toBuild = build.join(",");
            return <div />;
           // return <option value={ toBuild }> { 12 / toBuild.length + " columns"}</option>

        });
        return <select onChange={ this.onSelectChange } > {inside} </select>;
    };

    buildSectionDisplay = (child) => {

        return (
            <PageSection  child={ this.buildRowDisplay() }/>
        );

    };
    buildRowDisplay = () => {

        let styles = {
          rowPanel: {
              "position": "absolute",
              "top": "2px",
              "left": "55px",
              "right": "0",
              "bottom": "28px",
              "borderRadius" : "5px",
              "backgroundColor" : "#ffffff",

          },
          rowPanelLeftBar: {
              "height" : "100%",
              "position": "absolute",
              "top": "0",
              "left": "0",
              "bottom": "0",
              "padding": "8px",
              "backgroundColor" : "#03c3aa",
              "borderTopLeftRadius" : "5px",
              "borderBottomLeftRadius" : "5px",
          },
          rowPanelRightContainer: {
              "position": "absolute",
              "top": "0",
              "right": "0",
              "bottom": "0",
              "padding": "10px 10px",
              "min-height": "300px",
              "width": "100%",
          }
        };
        return (
            <div style={{ "width": "100%", "position": "relative","height": "100%" }}>
                <div className="" style={ styles.rowPanel }>
                    <div className="" style={ styles.rowPanelLeftBar }>
                        <div style={
                            {
                                "paddingLeft": "0",
                                "textAlign": "center",
                                "display": "flex",
                                "flexDirection": "column",
                                "justifyContent": "flex-start",
                                "height": "100%"

                            }
                        }>
                            <a className="border-0"><i className="fa fa-fw fa-edit m-y-10" style={{"color":"#383838","fontSize":"24px"}} /></a>
                            <a className="border-0" style={{"cursor": "pointer"}}><CopyIcon /></a>
                            <a className="border-0" style={{"cursor": "pointer"}}><ColumnsIcon /></a>
                            <a className="border-0" style={{"cursor": "pointer", "marginTop":"auto"}}><XIcon /></a>
                        </div>

                    </div>
                    <div className="row-panel-right-container" style={ styles.rowPanelRightContainer }> </div>

                </div>
                <div style={{ "position":"absolute", "left": "56px", "bottom": "1px" }}><AddItemIcon /> Add Item</div>
            </div>


        );
    };

    render() {
        return (
            <div className="row">
                <div className="col-md-12">

                    <PageSection>
                        <SectionRow cols={1}>
                            <div>
                                okay
                            </div>
                        </SectionRow>
                    </PageSection>

                </div>
            </div>
        );
    }
}

BlockComponent.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

BlockComponent.defaultProps = {
    //myProp: val
};

export default BlockComponent;

if (document.getElementById('block-component')) {
    ReactDOM.render(<BlockComponent />, document.getElementById('block-component'));
}
