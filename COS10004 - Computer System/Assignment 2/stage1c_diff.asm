; function stage1c_diff
; returns the difference between the max and min value out of three arguments passed in
; Arguments:
; r0 - first value
; r1 - second value
; r2 - third value
; Returns result in r0 register

stage1c_diff:
    push {r8,r9}

    push {r0,r1,r2,lr}
    bl stage1a_min   ;call min
    mov r8, r0      ;get the min value
    pop  {r0,r1,r2,lr}

    push {r0,r1,r2,lr}
    bl stage1b_max    ;call max
    mov r9, r0        ; get max value
    pop  {r0,r1,r2,lr}

    sub r0, r9, r8    ;find the difference
    pop {r8,r9}

    b end1