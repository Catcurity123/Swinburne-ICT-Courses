; function stage1b_max
; returns the maximum value out of three arguments passed in
; Arguments:
; r0 - first value
; r1 - second value
; r2 - third value
; Returns result in r0 register

stage1b_max:
  cmp r0, r1
  bhs max2
  b max1

max1:
 cmp r1,r2
 movle r0,r2
 movge r0,r1
 b end1

max2:
 cmp r0,r2
 bhs end1
 mov r0,r2
 b end1

