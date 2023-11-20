import { GameResult } from "../types/game";

export const renderResult = (gameResult: GameResult) => {
    return `<div class="d-flex justify-content-center mt-4 flex-wrap">` +
        `${gameResult.attempt.map((d, i) => renderCube(d, i, gameResult.matches)).join('')}` +
        `<div class="w-100 mt-2 fw-semibold">${gameResult.text}</div>` +
        `</div>`;
}

export const renderCube = (count: number = 1, index: number = 0, matches: number[]) => {
    const colors: string[] = ['red', 'green'];
    const cubeColor: string = matches.length <= 2 ? colors[matches.indexOf(count)] : (matches.includes(index) ? colors[0] : '');
    return `<div class="cube cube--${count}${cubeColor ? ` cube--${cubeColor}` : ''} d-flex align-items-center ms-2 me-2 flex-wrap justify-content-between" title="${count}">` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${count > 1 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${count >= 4 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${count % 2 !== 0 || count === 6 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${count === 6 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `<div class="cube__dot-block d-flex justify-content-center w-100">` +
        `${count > 1 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `${count >= 4 ? '<div class="w-50 d-flex justify-content-center"><div class="cube__dot"></div></div>' : ''}` +
        `</div>` +
        `</div>`;
}