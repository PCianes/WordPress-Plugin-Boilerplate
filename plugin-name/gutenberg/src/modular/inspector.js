/**
 * Internal block libraries
 */
const { __ } = wp.i18n;
const { Component } = wp.element;
const {
    InspectorControls,
    ColorPalette,
} = wp.editor;
const {
    Button,
    ButtonGroup,
    CheckboxControl,
    PanelBody,
    PanelRow,
    PanelColor,
    RadioControl,
    RangeControl,
    TextControl,
    TextareaControl,
    ToggleControl,
    Toolbar,
    SelectControl
} = wp.components;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

    constructor() {
        super( ...arguments );
    }

    render() {
        const { attributes: { checkboxControl, colorPaletteControl, radioControl, rangeControl, textControl, textareaControl, toggleControl, selectControl }, setAttributes } = this.props;

        return (
            <InspectorControls>
                <PanelBody
                    title={ __( 'Panel Body Title', 'plugin-name' ) }
                    initialOpen={ false }
                >
                    <PanelRow>
                        <p>{ __( 'Panel Body Copy', 'plugin-name' ) }</p>
                    </PanelRow>
                </PanelBody>

                <PanelBody>
                    <CheckboxControl
                        heading={ __( 'Checkbox Control', 'plugin-name' ) }
                        label={ __( 'Check here', 'plugin-name' ) }
                        help={ __( 'Checkbox control help text', 'plugin-name' ) }
                        checked={ checkboxControl }
                        onChange={ checkboxControl => setAttributes( { checkboxControl } ) }
                    />
                </PanelBody>

                <PanelColor
                    title={ __( 'Color Panel', 'plugin-name' ) }
                    colorValue={ colorPaletteControl }
                >
                    <ColorPalette
                        value={ colorPaletteControl }
                        onChange={ colorPaletteControl => setAttributes( { colorPaletteControl } ) }
                    />
                </PanelColor>

                <PanelBody>
                    <RadioControl
                        label={ __( 'Radio Control', 'plugin-name' ) }
                        selected={ radioControl }
                        options={ [
                            { label: 'Author', value: 'a' },
                            { label: 'Editor', value: 'e' },
                        ] }
                        onChange={ radioControl => setAttributes( { radioControl } ) }
                    />
                </PanelBody>

                <PanelBody>
                    <RangeControl
                        beforeIcon="arrow-left-alt2"
                        afterIcon="arrow-right-alt2"
                        label={ __( 'Range Control', 'plugin-name' ) }
                        value={ rangeControl }
                        onChange={ rangeControl => setAttributes( { rangeControl } ) }
                        min={ 1 }
                        max={ 10 }
                    />
                </PanelBody>

                <PanelBody>
                    <TextControl
                        label={ __( 'Text Control', 'plugin-name' ) }
                        help={ __( 'Text control help text', 'plugin-name' ) }
                        value={ textControl }
                        onChange={ textControl => setAttributes( { textControl } ) }
                    />
                </PanelBody>

                <PanelBody>
                    <TextareaControl
                        label={ __( 'Text Area Control', 'plugin-name' ) }
                        help={ __( 'Text area control help text', 'plugin-name' ) }
                        value={ textareaControl }
                        onChange={ textareaControl => setAttributes( { textareaControl } ) }
                    />
                </PanelBody>

                <PanelBody>
                    <ToggleControl
                        label={ __( 'Toggle Control', 'plugin-name' ) }
                        checked={ toggleControl }
                        onChange={ toggleControl => setAttributes( { toggleControl } ) }
                    />
                </PanelBody>

                <PanelBody>
                    <SelectControl
                        label={ __( 'Select Control', 'plugin-name' ) }
                        value={ selectControl }
                        options={ [
                            { value: 'a', label: __( 'Option A', 'plugin-name' ) },
                            { value: 'b', label: __( 'Option B', 'plugin-name' ) },
                            { value: 'c', label: __( 'Option C', 'plugin-name' ) },
                        ] }
                        onChange={ selectControl => setAttributes( { selectControl } ) }
                    />
                </PanelBody>

            </InspectorControls>
        );
    }
}
