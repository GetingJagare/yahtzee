import { GameResult } from "../types/game";

const processedDigits: number[] = [];

export const renderResult = (gameResult: GameResult) => {
    processedDigits.splice(0);
    return `<div class="d-flex justify-content-center mt-4 flex-wrap">` +
        `${gameResult.attempt.map((d, i) => renderCube(d, i, gameResult.matches)).join('')}` +
        `<div class="w-100 mt-2 fw-semibold">${gameResult.text}</div>` +
        `</div>`;
}

export const renderCube = (digit: number = 1, index: number = 0, matches: number[]) => {
    const colors: string[] = ['red', 'green'];
    const cubeColor: string = matches.length <= 2 ? colors[matches.indexOf(digit)]
        : (matches.includes(digit) && !processedDigits.includes(digit) ? colors[0] : '');
    const cube = `<div class="cube cube--${digit}${cubeColor ? ` cube--${cubeColor}` : ''} d-flex align-items-center ms-2 me-2 flex-wrap justify-content-between" title="${digit}">` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${digit > 1 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${digit >= 4 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${digit % 2 !== 0 || digit === 6 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${digit === 6 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${digit > 1 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${digit >= 4 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `</div>`;
    if (!processedDigits.includes(digit)) {
        processedDigits.push(digit);
    }
    return cube;
}