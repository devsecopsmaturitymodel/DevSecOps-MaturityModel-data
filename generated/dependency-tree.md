## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Pinning of artifacts)
1(L1 Defined build process)
2(L2 SBOM of components)
3(L3 Signing of code)
4(L5 Signing of artifacts)
5(L1 Automated deployment process)
6(L1 Defined deployment process)
7(L1 Version control)
8(L1 Inventory of production components)
9(L2 Inventory of production artifacts)
10(L3 Handover of confidential parameters)
11(L2 Environment depending configuration parameters secrets)
12(L3 Inventory of production dependencies)
13(L3 Rolling update on deployment)
14(L4 Canary deployment)
15(L4 Same artifact for environments)
16(L4 Usage of feature toggles)
17(L5 Blue/Green Deployment)
18(L4 Smoke Test)
19(L2 Automated merge of automated PRs)
20(L1 Automated PRs for patches)
21(L3 Automated deployment of automated PRs)
22(L3 Creation of simple abuse stories)
23(L1 Conduction of simple threat modeling on technical level)
24(L3 Creation of threat modeling processes and standards)
25(L4 Conduction of advanced threat modeling)
26(L5 Creation of advanced abuse stories)
27(L2 Regular security training of security champions)
28(L2 Each team has a security champion)
29(L2 Determining the protection requirement)
30(L2 App. Hardening Level 1)
31(L1 App. Hardening Level 1 50%)
32(L3 App. Hardening Level 2 75%)
33(L4 App. Hardening Level 2)
34(L5 App. Hardening Level 3)
35(L3 Block force pushes)
36(L2 Require a PR before merging)
37(L3 Dismiss stale PR approvals)
38(L3 Require status checks to pass)
39(L2 Backup)
40(L2 MFA)
41(L1 MFA for admins)
42(L2 Usage of test and production environments)
43(L2 Virtual environments are limited)
44(L2 Applications are running in virtualized environments)
45(L3 Immutable infrastructure)
46(L3 Infrastructure as Code)
47(L3 Limitation of system events)
48(L3 Audit of system events)
49(L3 Usage of security by default for components)
50(L3 WAF baseline)
51(L1 Context-aware output encoding)
52(L4 Production near environments are used by developers)
53(L4 WAF medium)
54(L5 WAF Advanced)
55(L2 Centralized application logging)
56(L2 Alerting)
57(L3 Visualized logging)
58(L1 Centralized system logging)
59(L5 Correlation of security events)
60(L2 Visualized metrics)
61(L2 Monitoring of costs)
62(L1 Simple application metrics)
63(L1 Simple system metrics)
64(L3 Advanced availability and stability metrics)
65(L3 Deactivation of unused metrics)
66(L3 Targeted alerting)
67(L4 Advanced app. metrics)
68(L4 Coverage and control metrics)
69(L4 Defense metrics)
70(L3 Filter outgoing traffic)
71(L4 Screens with metric visualization)
72(L3 Grouping of metrics)
73(L5 Metrics are combined with tests)
74(L2 Patching mean time to resolution via PR)
75(L3 Generation of response statistics)
76(L3 Usage of a vulnerability management system)
77(L4 Patching mean time to resolution via production)
78(L2 Artifact-based false positive treatment)
79(L1 Simple false positive treatment)
80(L3 Fix based on accessibility)
81(L1 Treatment of defects with high or critical severity)
82(L3 Global false positive treatment)
83(L2 Exploit likelihood estimation)
84(L3 Office Hours)
85(L2 Coverage of client side dynamic components)
86(L2 Usage of different roles)
87(L2 Simple Scan)
88(L3 Coverage of hidden endpoints)
89(L3 Coverage of more input vectors)
90(L3 Coverage of sequential operations)
91(L4 Usage of multiple scanners)
92(L5 Coverage of service to service communication)
93(L2 Test for exposed services)
94(L2 Isolated networks for virtual environments)
95(L2 Test network segmentation)
96(L3 Test for unauthorized installation)
97(L2 Evaluation of the trust of used components)
98(L2 Software Composition Analysis server side)
99(L2 Test for Time to Patch)
100(L2 Test libyear)
101(L3 API design validation)
102(L3 Software Composition Analysis client side)
103(L3 Static analysis for important client side components)
104(L3 Static analysis for important server side components)
105(L3 Test for Patch Deployment Time)
106(L4 Static analysis for all self written components)
107(L4 Usage of multiple analyzers)
108(L5 Dead code elimination)
109(L5 Exclusion of source code duplicates)
110(L5 Static analysis for all components/libraries)
111(L4 Correlate known vulnerabilities in infrastructure with new image versions)
112(L2 Usage of a maximum lifetime for images)
113(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 2
1 --> 3
1 --> 4
1 --> 5
1 --> 6
1 --> 15
1 --> 49
1 --> 87
1 --> 98
1 --> 100
1 --> 102
1 --> 103
1 --> 104
1 --> 105
1 --> 108
1 --> 109
0 --> 4
6 --> 5
6 --> 39
6 --> 42
7 --> 6
5 --> 8
5 --> 9
5 --> 13
5 --> 14
5 --> 52
5 --> 18
8 --> 9
8 --> 29
8 --> 80
8 --> 98
8 --> 101
8 --> 102
8 --> 103
8 --> 104
8 --> 106
8 --> 110
11 --> 10
9 --> 12
2 --> 12
15 --> 16
18 --> 17
20 --> 19
20 --> 74
20 --> 77
20 --> 99
20 --> 105
19 --> 21
23 --> 22
23 --> 24
23 --> 25
24 --> 22
24 --> 25
22 --> 26
28 --> 27
28 --> 76
31 --> 30
30 --> 32
32 --> 33
33 --> 34
36 --> 35
36 --> 37
36 --> 38
41 --> 40
44 --> 43
46 --> 45
46 --> 52
48 --> 47
51 --> 50
50 --> 53
53 --> 54
56 --> 55
56 --> 59
56 --> 66
58 --> 57
55 --> 57
57 --> 59
60 --> 56
60 --> 64
60 --> 48
60 --> 65
60 --> 67
60 --> 68
60 --> 69
62 --> 61
62 --> 60
62 --> 64
62 --> 67
63 --> 61
63 --> 60
70 --> 69
72 --> 71
72 --> 73
76 --> 75
76 --> 82
74 --> 77
79 --> 78
81 --> 80
78 --> 82
83 --> 76
83 --> 102
84 --> 76
86 --> 85
86 --> 88
86 --> 89
86 --> 90
86 --> 91
87 --> 86
87 --> 92
94 --> 93
94 --> 95
97 --> 96
98 --> 83
98 --> 107
103 --> 106
103 --> 110
104 --> 106
104 --> 110
102 --> 107
106 --> 107
112 --> 111
112 --> 113

O --> 1
O --> 7
O --> 11
O --> 20
O --> 23
O --> 28
O --> 31
O --> 36
O --> 41
O --> 44
O --> 46
O --> 51
O --> 58
O --> 62
O --> 63
O --> 70
O --> 72
O --> 79
O --> 81
O --> 84
O --> 94
O --> 97
O --> 112
```
