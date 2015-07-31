# Sudoku solver

This is a simple implementation to solve any square sudoku puzzle.

It was used in a php contest found [here](http://phpquiz.jaytaph.nl/quiz/1).

## Why

My personal goal was to create a working solution as fast as possible. Everything was created within a couple of hours.

## The algorithm

The solver is a single function that is executed until the puzzle is solved. Every round it goes through the following
flow. If a step succeeds, it wil run the solve function again.

  1. Fill the missing numbers (for example, if 1-8 is taken, fill 9)
  1. Fill the numbers that can not be put anywhere else. (this is the `forcedMove` method)
  1. Make a backup
  1. Find the place with the least possible values, fill a random one
  1. If the puzzle is no longer solvable, reset to the backup point
 
## OOP and SOLID?

Are you crazy?? That is for reusable code :)

## Minified php?

This is because the smallest solution (in bytes) would render 10 points. I considered it a quick win used an online 
minifier and did some "shift-f6"-ing in phpstorm.

## Brute force really?

Jup like I said, the goal was to make a working solution as fast as possible.

## How to run

#### The actual solver

```
cat puzzle | php solver.php
```

#### Tests

```
php tests.php
```