## DSOMM Activity Dependencies

The activities in this DSOMM Model have the following dependencies.

```mermaid
graph LR

0(L2 Basic data leak prevention)
1(L2 AI usage policy)
2(L4 Automated data leak detection for AI interactions)
3(L4 Hallucination detection for AI responses)
4(L4 Secure output handling in AI applications)
5(L3 Input validation for AI systems)
6(L1 Context-aware output encoding)
7(L5 Protection of agent memory against poisoning)
8(L2 Inventory of AI agents)
9(L2 Language and framework specific security rules)
10(L1 Static load of security rules)
11(L2 Spec-driven development)
12(L1 Version control)
13(L2 Threat modeling rule)
14(L1 Conduction of simple threat modeling on technical level)
15(L3 Audit logging of AI agent actions)
16(L2 Centralized application logging)
17(L3 Decommissioning of AI agents)
18(L3 Least privilege on external systems for AI agents)
19(L3 Evaluation of the trust of used AI components)
20(L2 Evaluation of the trust of used components)
21(L3 Threat modeling of AI components)
22(L4 Anomaly detection for AI agent behavior)
23(L2 Alerting)
24(L4 Dynamic load of security rules)
25(L5 Automated containment of anomalous AI agents)
26(L1 Usage of sandboxing for AI agents)
27(L2 Applications are running in virtualized environments)
28(L2 Rate limiting and resource budgets for AI systems)
29(L2 Monitoring of costs)
30(L2 Untrusted workspace handling for AI agents)
31(L2 Permission management for AI agents)
32(L3 Network isolation for AI agents)
33(L4 Human approval for irreversible AI agent actions)
34(L4 Trust boundaries between AI agents)
35(L4 Regular automated AI red teaming)
36(L3 Basic AI red teaming)
37(L2 Human review of AI generated plans)
38(L2 Human review of AI generated specifications)
39(L2 Self-verification of AI generated changes)
40(L1 Defined build process)
41(L2 Security unit tests for important components)
42(L2 Static and dynamic analysis of AI generated code)
43(L3 Static analysis for important server side components)
44(L2 Simple Scan)
45(L2 Validation of AI-suggested dependencies)
46(L2 Software Composition Analysis server side)
47(L3 Human review of AI generated code)
48(L3 No verification bypass for AI generated code)
49(L3 Security test generation with AI)
50(L4 Continuous detection of compromised AI components)
51(L3 Test for compromised components)
52(L5 Drift detection for agent instructions and guardrails)
53(L3 Drift detection for deployed configuration)
54(L2 Building and testing of artifacts in virtualized environments)
55(L2 Pinning of artifacts)
56(L2 SBOM of components)
57(L3 Signing of code)
58(L5 Signing of artifacts)
59(L1 Automated deployment process)
60(L1 Defined deployment process)
61(L1 Inventory of production components)
62(L2 Inventory of production artifacts)
63(L3 Handover of confidential parameters)
64(L2 Environment depending configuration parameters secrets)
65(L3 Inventory of production dependencies)
66(L3 Rolling update on deployment)
67(L4 Canary deployment)
68(L4 Same artifact for environments)
69(L4 Usage of feature toggles)
70(L5 Blue/Green Deployment)
71(L4 Smoke Test)
72(L2 Automated merge of automated PRs)
73(L1 Automated PRs for patches)
74(L3 Automated deployment of automated PRs)
75(L3 Creation of simple abuse stories)
76(L3 Creation of threat modeling processes and standards)
77(L4 Conduction of advanced threat modeling)
78(L5 Creation of advanced abuse stories)
79(L2 Regular security training of security champions)
80(L2 Each team has a security champion)
81(L2 Determining the protection requirement)
82(L2 App. Hardening Level 1)
83(L1 App. Hardening Level 1 50%)
84(L3 App. Hardening Level 2 75%)
85(L4 App. Hardening Level 2)
86(L5 App. Hardening Level 3)
87(L3 Block force pushes)
88(L2 Require a PR before merging)
89(L3 Dismiss stale PR approvals)
90(L3 Require status checks to pass)
91(L2 Backup)
92(L2 MFA)
93(L1 MFA for admins)
94(L2 Usage of test and production environments)
95(L2 Virtual environments are limited)
96(L3 Immutable infrastructure)
97(L3 Infrastructure as Code)
98(L3 Limitation of system events)
99(L3 Audit of system events)
100(L3 Usage of security by default for components)
101(L3 WAF baseline)
102(L4 Production near environments are used by developers)
103(L4 WAF medium)
104(L5 WAF Advanced)
105(L3 Logging of AI interactions)
106(L3 Visualized logging)
107(L1 Centralized system logging)
108(L5 Correlation of security events)
109(L2 Visualized metrics)
110(L1 Simple application metrics)
111(L1 Simple system metrics)
112(L3 Advanced availability and stability metrics)
113(L3 Deactivation of unused metrics)
114(L3 Targeted alerting)
115(L4 Advanced app. metrics)
116(L4 Coverage and control metrics)
117(L4 Defense metrics)
118(L3 Filter outgoing traffic)
119(L4 Screens with metric visualization)
120(L3 Grouping of metrics)
121(L5 Metrics are combined with tests)
122(L2 Patching mean time to resolution via PR)
123(L3 Generation of response statistics)
124(L3 Usage of a vulnerability management system)
125(L4 Patching mean time to resolution via production)
126(L2 Artifact-based false positive treatment)
127(L1 Simple false positive treatment)
128(L3 Fix based on accessibility)
129(L1 Treatment of defects with high or critical severity)
130(L3 Global false positive treatment)
131(L2 Exploit likelihood estimation)
132(L3 Office Hours)
133(L2 Coverage of client side dynamic components)
134(L2 Usage of different roles)
135(L3 Coverage of hidden endpoints)
136(L3 Coverage of more input vectors)
137(L3 Coverage of sequential operations)
138(L4 Usage of multiple scanners)
139(L5 Coverage of service to service communication)
140(L2 Test for exposed services)
141(L2 Isolated networks for virtual environments)
142(L2 Test network segmentation)
143(L3 Test for unauthorized installation)
144(L2 Test for Time to Patch)
145(L2 Test libyear)
146(L3 API design validation)
147(L3 Software Composition Analysis client side)
148(L3 Static analysis for important client side components)
149(L3 Test for Patch Deployment Time)
150(L4 Static analysis for all self written components)
151(L4 Usage of multiple analyzers)
152(L5 Dead code elimination)
153(L5 Exclusion of source code duplicates)
154(L5 Static analysis for all components/libraries)
155(L4 Correlate known vulnerabilities in infrastructure with new image versions)
156(L2 Usage of a maximum lifetime for images)
157(L4 Test of infrastructure components for known vulnerabilities)


1 --> 0
1 --> 8
1 --> 19
0 --> 2
4 --> 3
5 --> 4
5 --> 7
6 --> 4
6 --> 101
10 --> 9
10 --> 24
11 --> 9
11 --> 13
11 --> 24
11 --> 37
11 --> 38
12 --> 11
12 --> 60
14 --> 13
14 --> 21
14 --> 75
14 --> 76
14 --> 77
8 --> 15
8 --> 17
16 --> 15
16 --> 105
16 --> 106
18 --> 17
18 --> 25
18 --> 34
18 --> 47
20 --> 19
20 --> 143
15 --> 22
15 --> 33
15 --> 34
23 --> 22
23 --> 28
23 --> 16
23 --> 108
23 --> 114
13 --> 24
13 --> 49
22 --> 25
27 --> 26
27 --> 54
27 --> 95
29 --> 28
26 --> 30
26 --> 32
31 --> 18
31 --> 33
36 --> 35
38 --> 37
40 --> 39
40 --> 48
40 --> 55
40 --> 56
40 --> 57
40 --> 58
40 --> 59
40 --> 60
40 --> 68
40 --> 100
40 --> 44
40 --> 46
40 --> 145
40 --> 147
40 --> 148
40 --> 43
40 --> 149
40 --> 51
40 --> 152
40 --> 153
41 --> 39
43 --> 42
43 --> 48
43 --> 150
43 --> 154
44 --> 42
44 --> 48
44 --> 134
44 --> 139
46 --> 45
46 --> 131
46 --> 51
46 --> 151
47 --> 49
19 --> 50
51 --> 50
7 --> 52
53 --> 52
55 --> 58
60 --> 59
60 --> 91
60 --> 94
59 --> 61
59 --> 62
59 --> 53
59 --> 66
59 --> 67
59 --> 102
59 --> 71
61 --> 62
61 --> 81
61 --> 128
61 --> 46
61 --> 146
61 --> 147
61 --> 148
61 --> 43
61 --> 150
61 --> 154
64 --> 63
62 --> 65
56 --> 65
68 --> 69
71 --> 70
73 --> 72
73 --> 122
73 --> 125
73 --> 144
73 --> 149
72 --> 74
76 --> 75
76 --> 77
75 --> 78
80 --> 79
80 --> 124
83 --> 82
82 --> 84
84 --> 85
85 --> 86
88 --> 87
88 --> 89
88 --> 90
93 --> 92
97 --> 96
97 --> 102
99 --> 98
101 --> 103
103 --> 104
107 --> 106
106 --> 108
109 --> 23
109 --> 112
109 --> 99
109 --> 113
109 --> 115
109 --> 116
109 --> 117
110 --> 29
110 --> 109
110 --> 112
110 --> 115
111 --> 29
111 --> 109
118 --> 117
120 --> 119
120 --> 121
124 --> 123
124 --> 130
122 --> 125
127 --> 126
129 --> 128
126 --> 130
131 --> 124
131 --> 147
132 --> 124
134 --> 133
134 --> 135
134 --> 136
134 --> 137
134 --> 138
141 --> 140
141 --> 142
148 --> 150
148 --> 154
147 --> 151
150 --> 151
156 --> 155
156 --> 157

O --> 1
O --> 5
O --> 6
O --> 10
O --> 12
O --> 14
O --> 20
O --> 27
O --> 31
O --> 36
O --> 40
O --> 41
O --> 64
O --> 73
O --> 80
O --> 83
O --> 88
O --> 93
O --> 97
O --> 107
O --> 110
O --> 111
O --> 118
O --> 120
O --> 127
O --> 129
O --> 132
O --> 141
O --> 156
```
