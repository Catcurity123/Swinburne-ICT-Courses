; function stage1a_min
; returns the minimum value out of three arguments passed in
; Arguments:
; r0 - first value
; r1 - second value
; r2 - third value
; Returns result in r0 register

stage1a_min:
  cmp r0, r1
  bls min2
  b min1

min1:
 cmp r1,r2
 movle r0,r1
 movge r0,r2
 b end1

min2:
 cmp r0,r2
 bls end1
 mov r0,r2
 b end1

end1:
bx lr