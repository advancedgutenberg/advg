export function AdvDateTimeControl(props) {
    const { Button, DateTimePicker,  Popover, Tooltip } = wp.components;
    const { Fragment, useState } = wp.element;
    const { __ } = wp.i18n;

    const [popupState, setPopupState] = useState( false );
    const togglePopup = () => {
        setPopupState( ( state ) => ! state );
    };

    const {
        buttonLabel,
        dateLabel,
        date,
        onChangeDate,
        onDateClear,
        onInvalidDate
    } = props;

    return (
        <Fragment>
            <div className="advgb-advcalendar-control">
                <label>
                    { dateLabel }
                </label>
                <div>
                    <Button
                        isLink
                        icon="calendar"
                        onClick={ () => setPopupState( togglePopup ) }
                    >
                        <Tooltip text={ __( 'Change date', 'advanced-gutenberg' ) }>
                            <span>
                                { date ? moment( date ).format( "MMMM DD YYYY, h:mm a" ) : buttonLabel }
                            </span>
                        </Tooltip>
                    </Button>
                    { date &&
        				<Button
        					icon="no-alt"
                            className="advgb-advcalendar-remove-icon"
        					onClick={ () => onDateClear() }
        				/>
        			}
                </div>
            </div>
            { popupState &&
                <Popover
                    className="advgb-advcalendar-popover"
                    onClose={ setPopupState.bind( null, false ) }
                >
                    <label className="advgb-advcalendar-popover-label">
                        { dateLabel }
                        <Button
        					icon="no-alt"
                            className="advgb-advcalendar-remove-icon"
        					onClick={ () => setPopupState( togglePopup ) }
        				/>
                    </label>
                    <div className="advgb-advcalendar-popover-timezone">
                        { typeof advgbBlocks.timezone !== 'undefined' && advgbBlocks.timezone.length
                            ? `${advgbBlocks.timezone.replace(/_/g, ' ')} ${__( 'time', 'advanced-gutenberg' )}`
                            : __( 'WordPress settings timezone', 'advanced-gutenberg' ) }
                    </div>
                    <DateTimePicker
                        currentDate={ date }
                        onChange={ onChangeDate }
                        is12Hour={ true }
                        isInvalidDate={ onInvalidDate }
                    />
                </Popover>
            }
        </Fragment>

    )
}