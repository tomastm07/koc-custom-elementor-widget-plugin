import React, { useState, useMemo, useRef, useEffect } from "react";
import ReactSpeedometer from "react-d3-speedometer";
import Box from "@mui/material/Box";
import Slider from "@mui/material/Slider";
import PuffLoader from "react-spinners/PuffLoader";
import Items from "./Items";

const Speedometer = ({ items, variables, lastStep, lastValue }) => {
  const sliderRef = useRef(null);
  const speedoRef = useRef(null);

  const {
    show,
    showMarks,
    rightLabel,
    leftLabel,
    gapSize,
    textAlign,
    gapColor,
    needleSize,
    ringSize,
    unfilledSegmentColor,
    initialSegmentStyle,
  } = variables;

  const [currentValue, setCurrentValue] = useState(lastValue || 0);
  const [currentStep, setCurrentStep] = useState(lastStep || 0);
  const [changingDimension, setChangingDimension] = useState(false);
  const [segmentStyles, setSegmentStyles] = useState(initialSegmentStyle);
  const [loading, setLoading] = useState(true);

  const [dimensions, setDimensions] = useState({
    height: window.innerHeight,

    width: window.innerWidth,
  });

  const debounce = (fn, ms) => {
    let timer;

    return (_) => {
      clearTimeout(timer);
      setLoading(true);
      setChangingDimension((prev) => true);
      timer = setTimeout((_) => {
        timer = null;
        setChangingDimension((prev) => false);

        fn.apply(this);
      }, ms);
    };
  };

  useEffect(() => {
    setLoading((prev) => false);
    if (sliderRef.current) {
      const marks = sliderRef.current.querySelectorAll(".MuiSlider-mark");
      // remove the first and last slider step marks
      if (showMarks && marks.length >= 1) {
        marks[0].style.display = "none";
        marks[marks.length - 1].style.display = "none";
      }
      var event = new Event("input", { bubbles: true });
      sliderRef.current.dispatchEvent(event);
    }
    if (speedoRef.current) {
      //fix bug on chrome by removing the attribute height=0 that hides the speedometer component
      const meter = speedoRef.current.querySelector(".speedometer");
      if (meter) {
        meter.style.height = "inherit";
        meter.removeAttribute("height");
      }
    }
  }, []);

  useEffect(() => {
    //re-render the speedometer componente on window resize every 1 second (so the size updates)
    const debouncedHandleResize = debounce(function handleResize() {
      setDimensions((prev) => {
        setLoading(false);
        return {
          height: window.innerHeight,

          width: window.innerWidth,
        };
      });
    }, 1000);

    if (speedoRef.current) {
      const meter = speedoRef.current.querySelector(".speedometer");
      if (meter.hasAttribute("height")) {
        meter.style.height = "inherit";
        meter.removeAttribute("height");
      }
    }
    window.addEventListener("resize", debouncedHandleResize);

    return (_) => {
      window.removeEventListener("resize", debouncedHandleResize);
    };
  });

  const maxValue = 180;
  const length = items ? items.length : 0;
  const step = (180 - gapSize * (length - 1)) / length;

  //render custom props for the speedometer component
  const customProps = useMemo(() => {
    let stepCounter = 1;
    let gapCounter = 1;
    let data = 0;
    const stops = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx) {
        if (idx == 1) {
          return step;
        }

        data = step * stepCounter + gapSize * gapCounter;

        if (idx % 2 != 0) gapCounter++;
        if (idx % 2 == 0) stepCounter++;
        return data;
      }
      return idx;
    });
    let counter = 0;
    const colors = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx % 2 == 0) {
        const color = items[counter].dataColor;
        counter++;
        return color;
      }
      return gapColor;
    });

    return { stops, colors };
  }, []);
  const { stops, colors } = customProps;

  const onChange = (event) => {
    const value = event.target.value;

    const step = parseInt((value * length) / maxValue);

    const setValue = value == 0 || value == maxValue ? value : value - gapSize;

    //empty object use for setting the styling of the segments dynamically
    const emptyObject = {};
    emptyObject[`& .arc path:nth-child(odd):nth-child(n+${step * 2})`] = {
      fill: `${unfilledSegmentColor} !important`,
    };

    setSegmentStyles(emptyObject);

    /* set the current values of the slider to the global window object so on each 
    elementor rendering, the widget can go back to it's last state */
    setCurrentValue((lastVal) => {
      window.kocCurrentValue = value;
      return setValue;
    });
    setCurrentStep((lastStep) => {
      window.kocCurrentStep = step;
      return step;
    });
  };

  return loading ? (
    <div className="koc-spinner">
      <PuffLoader />
    </div>
  ) : (
    <Box sx={segmentStyles}>
      <Items items={items} currentStep={currentStep} textAlign={textAlign} className="items" />
      <div
        className="slider-inner-container"
        ref={speedoRef}
        style={{ display: `${show ? "block" : "none"}` }}
      >
        {!changingDimension && (
          <ReactSpeedometer
            fluidWidth={true}
            className="speedometer"
            value={currentValue}
            customSegmentStops={stops}
            segmentColors={colors}
            minValue={0}
            needleHeightRatio={needleSize}
            ringWidth={Number(ringSize)}
            maxValue={maxValue}
            labelFontSize={0}
            valueTextFontSize={0}
            needleTransitionDuration={100}
          />
        )}
      </div>
      <Box className="slider-track-container">
        <p className="label-slider label-right">{rightLabel}</p>
        <p className="label-slider label-left">{leftLabel}</p>
        <Slider
          className="slider"
          aria-label="slider-koc"
          defaultValue={currentValue}
          step={180 / length}
          onChange={onChange}
          min={0}
          max={maxValue}
          marks={showMarks}
          ref={sliderRef}
        />
      </Box>
    </Box>
  );
};

export default Speedometer;
